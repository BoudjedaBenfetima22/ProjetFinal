<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Models\Offer;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{

    public function index(Request $request)
    {
        return offer::orderBy('created_at','desc')->with(['images'])->get();

    }

    public function show($id){
            return Offer::with(['images'])->find($id);
    }
//    public function update(Request $request, $id)
//    {
//        $offer = Offer::find($id);
//
//        if(!$offer)
//        {
//            return response([
//                'message' => 'offer not found.'
//            ], 403);
//        }
//        $attrs = $request->validate([
//            'description' => 'string',
//            'localisation' => 'string',
//            'categorie' => 'string',
//            'prix' => 'double',
//            'nombre_des_chambres' => 'integer',
//            'nombre_des_salles_de_bain' => 'integer',
//            'nombre_des_cuisines' => 'integer',
//            'type_doffre' => 'string',
//            'wilaya' => 'string',
//            'agence_id' => 'unsignedBigInteger',]);
//        $offer->update([
//            'description' => $attrs['description'],
//            'localisation' => $attrs['localisation'],
//            'categorie' => $attrs['categorie'],
//            'prix' => $attrs['prix'],
//            'nombre_des_chambres' => $attrs['nombre_des_chambres'],
//            'nombre_des_salles_de_bain' => $attrs['nombre_des_salles_de_bain'],
//            'nombre_des_cuisines' => $attrs['nombre_des_cuisines'],
//            'type_doffre' => $attrs['type_doffre'],
//            'wilaya' => $attrs['wilaya'],
//            'agence_id' => $attrs['agence_id'],
//        ]);



        // for now skip for post image

//        return response([
//            'message' => 'Post updated.',
//            'post' => $offer
//        ], 200);
//    }

    public function store(Request $request)
    {
        $offer = Offer::create($request->all());
        if ($request->hasFile('image')) {
            $originalImage = $request->file('image');
            // Resize the image
            //$resizedImage = resizeImage($originalImage);
            $originalImage->store('public/images/offers');
            Storage::disk('public')->put('images/offers/' . $offer->id . '.jpg', $originalImage);

        } else if($request->hasFile('images')){

            foreach ($request->file('images') as $imagefile) {
                $image = new Image;
                $path = $imagefile->store('public/images/offers/'. $offer->id);
                $image->url = $path;
                $image->offer_id = $offer->id;
                $image->save();
            }
        }
        return response('Offer created ' . $offer->id, 201);
    }

    public function list(){
        return Offer::all();

    }

    public function destroy($id)
    {
        $offer = Offer::find($id);
        if($offer){
            $offer->delete();

            return response(['message'=>'offer deleted successfully'], 200);
        }
        else{
            return response(['message'=>' No offer found'], 404);
        }

    }
    public function update(Request $request ,$id)
    {
        $offer = Offer::find($id);
        $offer->update($request->all());
        return response($offer, 200);
        // return response()->json($offer);
    }
    public function appartementCat(Request $request)
    {
        return offer::where('categorie', '=', 'appartement')->with(['images'])->get();

    }
    public function villaCat(Request $request)
    {
        return offer::where('categorie', '=', 'villa')->with(['images'])->get();

    }
    public function studioCat(Request $request)
    {
        return offer::where('categorie', '=', 'studio')->with(['images'])->get();

    }
    public function housesCat(Request $request)
    {
        return offer::where('categorie', '=', 'house')->with(['images'])->get();

    }
}
