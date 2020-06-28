<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Product;

class PagesController extends Controller
{
    public function index(){
        $title = "Welcome to main page!";
        return view('pages.index')->with("mtitle",$title);
    }
    public function instructions(){
        return view('pages.instructions');
    }
    public function search(Request $request){
        $usersByName = User::where('name',$request->searchBar)->where('user_type','seller')->get();
        $usersByOPG = User::where('user_opg',$request->searchBar)->where('user_type','seller')->get();
        $usersByCounty = User::where('county',$request->searchBar)->where('user_type','seller')->get();
        $usersByCity = User::where('city',$request->searchBar)->where('user_type','seller')->get();
        $productsByType = Product::where('type',$request->searchBar)->get();
        $productsByDetailType = Product::where('detail_type',$request->searchBar)->get();
        $productsByCounty = Product::where('county',$request->searchBar)->get();
        $productsByLocation = Product::where('location',$request->searchBar)->get();
        $productsByUser = Product::where('user',$request->searchBar)->get();

        $data = array(
            'usersByName' => $usersByName,
            'usersByOPG' => $usersByOPG,
            'usersByCounty' => $usersByCounty,
            'usersByCity' => $usersByCity,
            'productsByType' => $productsByType,
            'productsByDetailType' => $productsByDetailType,
            'productsByCounty' => $productsByCounty,
            'productsByLocation' => $productsByLocation,
            'productsByUser' => $productsByUser
        );

        return view('pages.search')->with('search_result',$data);
    }

}
