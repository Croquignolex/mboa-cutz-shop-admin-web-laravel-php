@extends('layouts.app')

@section('app.master.title', page_title('Archives'))

@section('app.breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Archives',
        'icon' => 'mdi mdi-archive',
        'chain' => ['Archives']
    ])
@endsection

@section('app.master.body')
    <div class="row">
        {{--Admins--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $admins,
                'bg_class' => 'bg-primary',
                'icon' => 'mdi mdi-account-multiple',
                'label' => 'Administrateurs archivés',
                'url' => route('archives.admins.index'),
            ])
        </div>
        {{--Produts--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $products,
                'bg_class' => 'bg-info',
                 'icon' => 'mdi mdi-basket',
                'label' => 'Produits archivés',
                'url' => route('archives.products.index'),
            ])
        </div>
        {{--Categories--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $categories,
                'bg_class' => 'bg-danger',
                 'icon' => 'mdi mdi-database',
                'label' => 'Catégories archivées',
                'url' => route('archives.categories.index'),
            ])
        </div>
        {{--Tags--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $tags,
                'bg_class' => 'bg-success',
                'label' => 'Etiquettes archivées',
                 'icon' => 'mdi mdi-tag-multiple',
                'url' => route('archives.tags.index'),
            ])
        </div>
        {{--Testimonials--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
               'data' => $testimonials,
                'icon' => 'mdi mdi-face',
               'bg_class' => 'bg-warning',
               'label' => 'Témoignages archivés',
               'url' => route('archives.testimonials.index'),
           ])
        </div>
    </div>
@endsection