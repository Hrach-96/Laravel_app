<?php
  $user = \App\User::find(Session::get('userData')->id);
  $background_color = (\App\CategoryOfTheUser::where('user_id',$user->id)->first())? \App\CategoryOfTheUser::where('user_id',$user->id)->first() : "" ;
  $background_color = (isset($background_color->category->color))? $background_color->category->color : "#F1C40F" ;
?>
<style>
  .propg-sec-wrp:after,
  .propg-sec-wrp:before {
    position: absolute;
    background-color: <?=$background_color?>;
    content: "";
    z-index: 1;
  }
</style>
<div class="page-wrpper">
  <header class="header inner-pages-header">
    <div class="container-fluid responsive_container_fluid">
      <div class="profile-section">
        <div class="">
          <div class="logo text-center">
            <a href="{{ route('user.dashboard') }}">

              <img class="img_class_85" src="{{ asset('images/Schools/' . $schoolInfo->logo) }}" />
            </a>
          </div>
          <div class="m-auto">
            <ul class="profile-menu responsive_part_ul" id="myTab">
              <li> <a href="{{ route('admin.dashboard') }}">Accueil</a> </li>
              <li> <a href="{{ route('admin.blog') }}" class="{{ Route::current()->getName()=="admin.addblog"?'active':'' }}" >Actualités</a> </li>
              <li><a href="{{ route('admin.statistics') }}" class="{{ Route::current()->getName()=="admin.statistics"?'active':'' }}">Statistiques</a></li>
              <li> <a href="{{ route('admin.directory') }}" class="{{ Route::current()->getName()=="admin.directory"?'active':'' }}" >Annuaire</a> </li>
              <li> <a href="{{ route('admin.mentorship') }}"  class="{{ Route::current()->getName()=="admin.mentorship"?'active':'' }}" >Mentorat</a> </li>
              <li> <a href="{{ route('admin.job-offer') }}"  class="{{ Route::current()->getName()=="admin.job-offer"?'active':'' }}" >Emplois / stages</a> </li>
              <li> <a href="{{ route('admin.emailing') }}"  class="{{ Route::current()->getName()=="admin.emailing"?'active':'' }}" >Emailing</a> </li>
              <li class="dropdown-li">
                <a href="{{ route('admin.profile') }}">
                  @if(!is_null($user->avatar))
                    <img class="mr-3 d-inline-block header_img" src="{{ asset('/images/avatar/'.$user->avatar) }}" >
                  @else
                    <img class="mr-3 d-inline-block header_img" src="{{ asset('/images/avatar/default.jpg') }}" >
                  @endif
                </a>
                <div class="dropdown-content">
                  <ul class="dropdown-content-list">
                    <li><a href="{{ route('admin.profile') }}">Profil</a></li>
                    <li><a href="#">Paramètres</a></li>
                    <li><a href="{{ route('admin.logout') }}">Se déconnecter</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="directory-pg-banner background_image_for_most_part inner-banner mentorship_banner" style="background:url({{ asset('images/Schools/'. $schoolInfo->background_image)}}) no-repeat;background-size: cover;-webkit-filter: blur(6px);filter: blur(6px);background-position: center;position: relative;filter: blur(6px);-webkit-filter: blur(6px);background-color: #333">
    <div class="container-fluid"></div>
  </div>
