@extends('layouts.app')
@section('content')
    <router-view></router-view>
    <router-link to='/'>Home</router-link>
    <router-link to='/about'>About</router-link>
    <router-link to='/login'>Login</router-link>
    <router-link to='/register'>Regsiter</router-link>

@endsection