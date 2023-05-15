<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\DB;
use App\Models\Tb_articles;
use App\Models\typearticleModel;
use App\Models\EntrepriseModel;
use App\Models\Commande;
use APP\Models\LivraisonModel;
use App\Models\Classe;
use Carbon\Carbon;

class dashbordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Tb_articles::all();
        $categories = typearticleModel::all();
        // $commandes = Commande::all();
        $commandes = Commande::whereDate('created_at', Carbon::today())->get();
        $classe = Classe::all();
        $orders = Commande::whereDate('created_at', Carbon::today())->get();
        return view('dashboard', compact('articles', 'categories', 'commandes','orders','classe'));
    }

    public function upload(Request $request)
    {
        //return $test  = Tb_articles::where('LibelleArticle','like', "%mathématiques%")->get();
        // echo (new TesseractOCR('catalogue/assets/images/size-banner-widget.jpg'))->run();
        $request->validate([
            "image"=>"required|mimes:png,jpg,jpeg|max:10000"
        ]);

        $classe = $request->get('classe');
        $classe =  Tb_articles::where('classe','=', $classe);
        // $classe = Tb_articles::query();
        // if ($classe) {
            # code...
            if ($image = $request->file('image')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $fileNameTostore = $image->move($destinationPath, $profileImage);
                $input['ImageArticle'] = "$profileImage";
            }
            //$tesseractOcr = new TesseractOCR('catalogue/assets/images/liste_fourniture.jpeg');
            $tesseractOcr = new TesseractOCR($fileNameTostore);
            $text = $tesseractOcr->run();
            $pieces = array();
            $pieces = preg_split("/[\\r\\t\\n]+/i", $text);

            $resultat = collect();
            foreach($pieces as $piece){
                $query = $classe;
                $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~', '*'];
                $piece = str_replace($reservedSymbols, '', $piece);
                $piece = implode('+',explode(' ',$piece));
                $resultat = $resultat->merge($query->select('*')->selectRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$piece])
                        ->whereRaw("MATCH (LibelleArticle) AGAINST (? IN BOOLEAN MODE)", $piece)
                        ->orderByDesc('relevance_score')->get());
            }

            $resultat = $resultat->unique('id');

            return response()->json($resultat); //->sum('PrixArticle')
        // }
        // DB::table('songs')->select('*')->selectRaw("MATCH (title) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$s])
        // ->whereRaw("MATCH (title) AGAINST (? IN BOOLEAN MODE)", $s)
        // ->orderByDesc('relevance_score')->paginate(30);
    }

    public function get_search_dynamique($query)
    {
        # code...
        $result = DB::select($query);
        return $result;
    }

    public function query_get_search_dynamique()
    {
        // $tesseractOcr = new TesseractOCR('catalogue/assets/images/liste_fourniture.jpeg');
        // //$tesseractOcr = new TesseractOCR($fileNameTostore);
        // $text = $tesseractOcr->run();
        // $pieces = array();
        // return $pieces = preg_split("/[\\r\\t\\n]+/i", $text);
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

        //  $result = new clsResultFunction();
        //   $result->objet = $search;
        //   if(count($search)<=0)
        //   {
        //     $result->bSuccess=false;
        //     $result->message = "echec";
        //   }
        //   else
        //   {
        //     $result->bSuccess=true;
        //     $result->message = "succes";
        //   }

          return response()->json($search);


    }

    public function cp1()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = 'cp1';//request()->get('text');
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
        // $articles = Tb_articles::where('IdTypeArticle', '=', $id)
        //                          ->paginate(6);
         //return response()->json($search);

         return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises'));
    }

    public function search()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
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

        $articles =  $this->get_search_dynamique($requete);

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();

        return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises'));
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
        $table = 'tb_articles';//request()->get('nomTable');
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

        // $image = $request->get('classe');
        // if ($image = $request->file('image')) {
        //     $destinationPath = 'images/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $fileNameTostore = $image->move($destinationPath, $profileImage);
        //     $input['ImageArticle'] = "$profileImage";
        // }
        // $tesseractOcr = new TesseractOCR($fileNameTostore);
        // $text = $tesseractOcr->run();
        // $pieces = array();
        // $pieces = preg_split("/[\\r\\t\\n]+/i", $text);
        // $resultat = collect();
        // foreach($pieces as $piece){
        //     $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~', '*','cahier','Cahier', 'livre', 'bic', 'de', 'Mathématiques', 'maternelle', 'Paquet'];
        //     $piece = str_replace($reservedSymbols, '', $piece);
        //     $resultat = $resultat->merge(Tb_articles::select('*')->selectRaw("MATCH (LibelleArticle,classe) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$piece])
        //             ->whereRaw("MATCH (LibelleArticle,classe) AGAINST (? IN BOOLEAN MODE)", $piece)
        //             ->orderByDesc('relevance_score')->get());
        // }

        // $resultat = $resultat->unique('id');

        // return response()->json($resultat);
    }

    public function cp2()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = 'cp2';//request()->get('text');
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
        // $articles = Tb_articles::where('IdTypeArticle', '=', $id)
        //                          ->paginate(6);
         //return response()->json($search);

         return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises'));
    }

    public function ce1()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = 'ce1';//request()->get('text');
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
        // $articles = Tb_articles::where('IdTypeArticle', '=', $id)
        //                          ->paginate(6);
         //return response()->json($search);

         return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises'));
    }

    public function ce2()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = 'ce2';//request()->get('text');
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
        // $articles = Tb_articles::where('IdTypeArticle', '=', $id)
        //                          ->paginate(6);
         //return response()->json($search);

         return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises'));
    }

    public function cm1()
    {
        # code...
        $table = 'tb_articles';//request()->get('nomTable');
        $table = $table;
        $text = 'cm1';//request()->get('text');
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
        // $articles = Tb_articles::where('IdTypeArticle', '=', $id)
        //                          ->paginate(6);
         //return response()->json($search);

         return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises'));
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

        $articles =  $this->get_search_dynamique($requete);

        $categories = typearticleModel::whereNull('type_parent_id')->with(['sous_types', 'sous_types.articles'])->orderBy('LibCategorieArt')->get();
        $entreprises = EntrepriseModel::orderBy('LibelleEntreprise')->get();
        // $articles = Tb_articles::where('IdTypeArticle', '=', $id)
        //                          ->paginate(6);
         //return response()->json($search);

         return view('front.catalogue.fourniture', compact('articles', 'categories', 'entreprises'));
    }
}
