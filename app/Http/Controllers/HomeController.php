<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Tb_articles;
use App\Models\typearticleModel;
use App\Models\EntrepriseModel;
use App\Models\Client;
use Session;
use App\Models\Panier;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
        //return view('home');
    }

    public function signup()
    {
        # code...
        return view('front.compte.signup');
    }

    public function login()
    {
        # code...
        return view('front.compte.login');
    }

    public function creerCompte(Request $request){
        $this->validate($request, [
            'nom'=>'required',
            'prenom'=>'required',
            'numero'=>'required',
            'email'=>'email|required|unique:clients',
            'password'=>'required|min:4'
        ]);
        $client = new Client();
        $client->nom = $request->input('nom');
        $client->prenom = $request->input('prenom');
        $client->email = $request->input('email');
        $client->numero = $request->input('numero');
        $client->password = bcrypt($request->input('password'));
        $client->save();
        return redirect()->route('login-client')->with('status', 'votre compte a été créé avec succès');
    }

    public function acceder_compte(Request $request)
    {
        # code...
        $this->validate($request, [
            'email'=>'email|required',
            'password'=>'required|min:4'
        ]);

        $client = Client::where('email', $request->input('email'))->first();
        if ($client) {
            # code...
            if (Hash::check($request->input('password'), $client->password)) {
                # code...
                Session::put('client', $client);
                return redirect('/');
            }else {
                # code...
                return back()->with('status', 'Mauvais mot de passe ou email');
            }
        }else {
            # code...
            return back()->with('status', 'Vous n'."'".'avez pas de comptes');
        }

    }

    public function logoutClient()
    {
        # code...
        Session::forget('client');
        return back();
    }

    public function typeaheadSearch(Request $request)
    {
          $dbQuery = $request->get('query');
          $output = Tb_articles::where('LibelleArticle', 'LIKE', '%'. $dbQuery. '%')->get();
          return response()->json($output->map( function($e){
              return ['id'=>$e->id, 'name'=>$e->LibelleArticle];
          }));
    }

    public function upload(Request $request)
    {
        if (empty(Session::get('client')['nom'])) {
            return redirect('login-client');
        }else {
            $request->validate([
                "image"=>"required|mimes:png,jpg,jpeg|max:10000"
            ]);
            $articles = Tb_articles::whereIn('LibelleArticle', ['cahier', 'stylo', 'gomme'])->get();
            $classe = $request->get('classe');
            $articles = Tb_articles::where('classe', '=', $classe)->get();

            if ($image = $request->file('image')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $fileNameTostore = $image->move($destinationPath, $profileImage);
                $input['ImageArticle'] = "$profileImage";
            }

            $tesseractOcr = new TesseractOCR($fileNameTostore);
            $text = $tesseractOcr->run();
            $pieces = preg_split("/[\\r\\t\\n]+/i", $text);

            $resultat = collect();

            foreach ($pieces as $piece) {
                $query = Tb_articles::where('classe', '=', $classe)
                    ->select('*')
                    ->selectRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$piece])
                    ->whereRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE)", $piece)
                    ->orderByDesc('relevance_score')
                    ->get();

                $resultat = $resultat->concat($query);
            }

            $articles = $resultat->unique('id');

            foreach ($articles as $article) {
                $panier = $this->_getPanier($request);
                $panier->addArticle($article, 1)->refresh();
            }

            $panier = $this->_getPanier($request);
            $produits = Tb_articles::whereIn('id', [3, 4, 5, 6, 7])->get();

            return view('front.catalogue.scanner', compact('panier', 'pieces', 'produits'));

            
        }

        // for ($i=0; $i < count($pieces)  ; $i++) {
        //     # code...
        //     $query = $classe;
        //     $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~', '*'];
        //     $piece = str_replace($reservedSymbols, '', $pieces);
        //     $piece = implode('+',$piece);
        //     $resultat = $resultat->concat($query->select('*')->selectRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$piece])
        //             ->whereRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE)", $piece)
        //             ->orderByDesc('relevance_score')->get());
        // }

    }

    private function _getPanier(Request $request)
    {
        $uuid = $request->cookie('uuid', Str::uuid());
        Cookie::queue('uuid', $uuid, 30*24*60); // 30 jours (en minutes)
        $panier = Panier::firstOrCreate([
            'uuid' => $uuid,
            'etat' => 'actif',
        ]);

        return $panier;
    }



    public function get_search_dynamique($query)
    {
        # code...
        $result = DB::select($query);
        return $result;
    }

    public function query_get_search_dynamique()
    {
        
        $pieces = [
            "JSapprends a la maternelle : Mathématique",
            "‘Japprends a la maternelle : coloriage",
            "02 livrets de conte 4a 5 ans",
            "O1 rame de papier Ad double A / Berga",
            "08 chemises & rabat",
            "05 chemises cartonnées",
            "02 pochettes de canson couleur vive 160x/m\"",
            "02 pochettes de canson blane 224,",
            "Papier crépon (jaune, rose fuchard, vert, blane, rouge, bleu)",
            "Papier bristol (rouge, bleu, blane, vert) grande feuilles 2703",
            "01 lot de 10 papiers hygiéniques Guprémes ou lotus)",
            "4 boites dle mouchoir en papier (200)",
            "01 Ardoise",
            "02 paquets de feutre Bic (gros bout et petit boud)",
            "02 paquets dle crayons de couleur plastidécor (Bic)",
            "Peinture A eau (gouache) blane, jaune, rose (Giotto)",
            "Colle vinylique blanche 1L Giotto) + 01 boite de colle colombe",
            "02 crayons a papier",
            "01 rouleau de scotch transparent 19mm",
            "O1 paquet de pinceaux",
            "01 Boite de craie blanche Giotto + 01 boite de couleur",
            "01 paquet de gommette auto copy Pa",
            "01 cahier double ligne",
        ];

        $table = request()->get('nomTable');
        $table = $table;


        foreach($pieces as $piece){
            //$text = $piece;//request()->get('text');
            $text = 'concat('."'".'%'."','".$piece."','".'%'."'".')';

            $requete = " select * from ".$table." where ";

            $result =  DB::select("SHOW COLUMNS FROM ".$table."");

            foreach($result as $row)
            {
                $term = $row->Field;
                $requete =$requete.' '. $term.' like '. $text.'  OR   ';

            }
            $requete = substr($requete,0,strlen($requete)-7);
        }

        return $search =  $this->get_search_dynamique($requete);

          return response()->json($search);


    }

    public function cp1()
    {
        
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'cp1';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);
        $articles = collect($this->get_search_dynamique($requete)); // Remplacez "10" par le nombre d'articles que vous souhaitez afficher par page

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
        // $classe = $articles["0"]->classe;
        return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function ps()
    {
        
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'PS';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);
        $articles = collect($this->get_search_dynamique($requete)); // Remplacez "10" par le nombre d'articles que vous souhaitez afficher par page

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
        // $classe = $articles["0"]->classe;
        return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function ms()
    {
        
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'MS';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);
        $articles = collect($this->get_search_dynamique($requete)); // Remplacez "10" par le nombre d'articles que vous souhaitez afficher par page

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
        // $classe = $articles["0"]->classe;
        return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function gs()
    {
        
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'GS';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);
        $articles = collect($this->get_search_dynamique($requete)); // Remplacez "10" par le nombre d'articles que vous souhaitez afficher par page

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
        // $classe = $articles["0"]->classe;
        return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function autocomplete()
    {
        $term = request()->get('term');

        // Effectuez votre requête pour récupérer les suggestions d'autocomplétion
        $suggestions = DB::table('tb_articles')
            ->select('LibelleArticle') // Remplacez 'nom_colonne' par le nom de la colonne que vous souhaitez utiliser pour l'autocomplétion
            ->where('LibelleArticle', 'LIKE', '%' . $term . '%')
            ->get()
            ->pluck('LibelleArticle');

        return response()->json($suggestions);
    }


    public function search()
    {
        try {
            # code...
        $table = 'tb_articles';
        $table = $table;
        $text = request()->get('search');
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

        return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
        } catch (\Exception $e) {
            // $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
            // $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
            return view('front.error.error', [
                'error' => $e->getMessage(),
                'categories'=>typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get()
            ]);
        }
    }

    public function commandeSpeciale()
    {
        # code...
        return view('front.image-article.create');
    }

    public function searchSpeciale(Request $request)
    {
        # code...
        $request->validate([
            "image"=>"required|mimes:png,jpg,jpeg|max:10000"
        ]);
        $table = 'tb_articles';
        $table = $table;
        $text = request()->get('classe');
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';
        }
        $requete = substr($requete,0,strlen($requete)-7);
        $articles =  $this->get_search_dynamique($requete);
        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
        return view('front.catalogue.tri', compact('articles', 'categories', 'entreprises'));

    }

    public function cp2()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'cp2';
         $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function ce1()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'ce1';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function ce2()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'ce2';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function cm1()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = 'cm1';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function cm2()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = 'cm2';//request()->get('text');
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function sixieme()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = '6ème';//request()->get('text');
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function cinquieme()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = '5ème';//request()->get('text');
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function quatrieme()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = '4ème';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';
        $requete = " select * from ".$table." where ";
        $result =  DB::select("SHOW COLUMNS FROM ".$table."");
        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function troisieme()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = '3ème';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function seconde()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = '2nd';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function premiere()
    {
        # code...
        $table = 'tb_articles';
        $table = $table;
        $text = '1ère';
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

         // Paginer la collection manuellement
         $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
         $perPage = 9; // Nombre d'articles à afficher par page
         $paginatedArticles = new LengthAwarePaginator(
             $articles->forPage($currentPage, $perPage),
             $articles->count(),
             $perPage,
             $currentPage,
             ['path' => request()->url(), 'query' => request()->query()]
         );
 
         $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }

    public function terminal()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = 'tle';//request()->get('text');
        $text = 'concat('."'".'%'."','".$text."','".'%'."'".')';

        $requete = " select * from ".$table." where ";

        $result =  DB::select("SHOW COLUMNS FROM ".$table."");

        foreach($result as $row)
        {
            $term = $row->Field;
            $requete =$requete.' '. $term.' like '. $text.'  OR   ';

        }
        $requete = substr($requete,0,strlen($requete)-7);

        $articles =  collect($this->get_search_dynamique($requete));

        // Paginer la collection manuellement
        $currentPage = request()->query('page', 1); // Récupérer le numéro de page actuel depuis la requête
        $perPage = 9; // Nombre d'articles à afficher par page
        $paginatedArticles = new LengthAwarePaginator(
            $articles->forPage($currentPage, $perPage),
            $articles->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $articles = $paginatedArticles;

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

         return view('front.catalogue.listeClasse', compact('articles', 'categories', 'entreprises'));
    }



}
