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
        {{--Clients--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $customers,
                'bg_class' => 'bg-warning',
                'icon' => 'mdi mdi-account-group',
                'label' => 'Clients archivés',
                'url' => route('archives.customers.index'),
            ])
        </div>
        {{--Products--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $products,
                'bg_class' => 'bg-info',
                'icon' => 'mdi mdi-basket',
                'label' => 'Produits archivés',
                'url' => route('archives.products.index'),
            ])
        </div>
        {{--Services--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $services,
                'bg_class' => 'bg-success',
                'icon' => 'mdi mdi-shopping',
                'label' => 'Services archivés',
                'url' => route('archives.services.index'),
            ])
        </div>
        {{--Events--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $events,
                'bg_class' => 'bg-dark',
                'icon' => 'mdi mdi-string-lights',
                'label' => 'Evènements archivés',
                'url' => route('archives.events.index'),
            ])
        </div>
        {{--Pictures--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
                'data' => $pictures,
                'bg_class' => 'bg-secondary',
                'icon' => 'mdi mdi-image-multiple',
                'label' => 'Images archivées',
                'url' => route('archives.pictures.index'),
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
        {{--Articles--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
               'data' => $articles,
               'icon' => 'mdi mdi-blinds',
               'bg_class' => 'bg-dark',
               'label' => 'Articles archivés',
               'url' => route('archives.articles.index'),
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
        {{--Product reviews--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
               'data' => $product_reviews,
               'icon' => 'mdi mdi-comment-text',
               'bg_class' => 'bg-info',
               'label' => 'Commentaires sur produit archivés',
               'url' => route('archives.product-reviews.index'),
           ])
        </div>
        {{--Service reviews--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
               'data' => $service_reviews,
               'icon' => 'mdi mdi-comment-text-outline',
               'bg_class' => 'bg-primary',
               'label' => 'Commentaires sur service archivés',
               'url' => route('archives.service-reviews.index'),
           ])
        </div>
        {{--Article comments--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
               'data' => $article_comments,
               'icon' => 'mdi mdi-comment',
               'bg_class' => 'bg-danger',
               'label' => 'Commentaires sur article archivés',
               'url' => route('archives.article-comments.index'),
           ])
        </div>
        {{--Contact messages--}}
        <div class="col-md-6 col-lg-3">
            @include('partials.archive.archive-card', [
               'data' => $contacts,
               'icon' => 'mdi mdi-email-open-multiple',
               'bg_class' => 'bg-secondary',
               'label' => 'Messages de contact archivés',
               'url' => route('archives.contacts.index'),
           ])
        </div>
    </div>
@endsection