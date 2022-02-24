<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loja;
use App\Models\Setor;
use PhpParser\Node\Expr\Exit_;

class LojaController extends Controller
{
    //
    public function index()
    {
        $lojas = Loja::all();
        return view('welcome', ['lojas' => $lojas]);
    }

    public function create()
    {

        $setors = Setor::all();
        return view('loja.create', ['setors' => $setors]);
    }

    public function store(Request $request)
    {

        $Loja = new Loja;
        $Loja->name     = ucfirst($request->name);
        $Loja->email    = $request->email;  
        $Loja->phone    = $request->phone;
        $Loja->cep      = $request->cep;  
        $Loja->city     = ucfirst($request->city);
        $Loja->uf       = $request->uf;
        $Loja->district = ucfirst($request->district);
        $Loja->street   = ucfirst($request->street);
        $Loja->number   = $request->number;
        $Loja->sectors  = $request->sectors;

        // upload Redimensinamento de imagem 
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $temporaryImage =  imagecreatefromjpeg($requestImage->getPathname());
            $originalWidth = imagesx($temporaryImage);
            $originalHeight = imagesy($temporaryImage);
            // Largura e altura pretendida em pixels
            $newWidth = 324;
            $newHeight = 172;
            $resizeImage = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resizeImage, $temporaryImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
            $extension  = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            imagejpeg($resizeImage, 'images/loja/' . $imageName);
            $Loja->photo = $imageName;
        }
        $Loja->save();
        return redirect('/')->with('msg', 'Unidade cadastrada com sucesso!!');
    }

    public function update()
    {
    }
}
