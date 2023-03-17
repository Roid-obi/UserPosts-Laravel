@extends('layouts.app')

@section('content')


    

        {{-- <div class="container py-2">
            <div class="row">
                @foreach ($postsaves as $post)
                    <div class="col-md-4 my-2">
                        <div class="card">
                            @if ($post->post->image != 'none')
                                <img src="{{ asset('/storage/public/images/'.$post->post->image) }}" class="card-img-top img-fluid" style="max-height: 230px">
                            @else
                                <img src="{{ asset('/images/hehehehe.png') }}" class="card-img-top img-fluid" style="max-height: 230px">
                            @endif
                            <div class="card-body">
                                <h4 class="card-title text-truncate">
                                    {{ $post->post->title }}
                                </h4>
                                <p class="card-text text-truncate">
                                    {!! $post->post->content !!}
                                </p>
                                <p class="card-text">by: {{ $post->post->created_by }}</p>
                                <small class="text-muted float-end"><i class="bi bi-eye-fill"></i> {{ $post->post->views }}</small>
                            </div>
                                <a href="/posts/{{ $post->post->slug }}" class="card-footer text-center">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}



        <main>

            
          
            <div class="album py-5 bg-light">
              <div class="container">
          
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          
                @foreach ($postsaves as $post)
                    <div class="kartu-posting">
                      <div class="col">
                        <div class="card">
                          {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> --}}
                        <div class="imagecard overflow-hidden">
                          <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{ asset('/storage/public/images/'.$post->post->image) }}" alt="" style="border-radius: 0px; object-fit: cover;">
                        </div>
                          <div class="card-body">
          
          
                            <p class="card-text">{{ $post->post->title }}</p>
          
                                                          @foreach($post->post->categories as $category)
                                                              <div class="namacatego btn-outline-secondary btn-sm">
                                                                  <a href="{{ route('post.category', $category->id) }}">
                                                                      {{ $category->nama }}
                                                                  </a>
                                                              </div>
                                                          @endforeach
                                                          @foreach($post->post->tags as $tag)
                                                              <div class="namatag btn-outline-secondary btn-sm" >
                                                                  <a href="{{ route('post.tag', $tag->id) }}">
                                                                      #{{ $tag->nama }}
                                                                  </a>
                                                              </div>
                                                          @endforeach
          
                                                          <small>Views : {{ $post->post->views }}</small>
                            {{-- <small class="text-muted float-end"><i class="bi bi-eye-fill"></i> {{ $post->post->views }}</small> --}}
                                      
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                <a href="/posts/{{ $post->post->slug }}">
                                <button   type="button"  class="btn btn-sm btn-outline-secondary mt-3">View</button>
                              </a>
                              
          
                                {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                              </div>
                              <small class="text-muted">{{ $post->post->updated_at }}</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                @endforeach
          
                  
          
                </div>
              </div>
            </div>
          
          </main>
    
@endsection

