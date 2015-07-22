@extends('layouts.master')

@section('title', 'Gallery')
@section('body_class', 'blurbg')

@section('content')

<div class="modal fade screenshot-gallery-popup" id="screenshotModal" tabindex="-1" role="dialog" aria-labelledby="screenshotModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="screenshotModalLabel">Screenshot</h4>
      </div>
      <div class="modal-body">
        <div class="screenshot screenshot-loading">
            <img src="" class="display-screenshot" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <section class="screenshot-gallery">
            <div class="row">
                <div class="col-md-6">
                    <h1>Gallery</h1>
                </div>
                <div class="col-md-6 text-right">
                    @if(Auth::user()->hasRole('members'))
                        <div class="gallery-upload-form">
                            <form enctype="multipart/form-data" action="/gallery/upload" class="form-inline" method="POST">
                                 {!! csrf_field() !!}
                                 <input type="file" class="form-control" accept="image/*" name="screenshot" />
                                 <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            <hr />
            @foreach ($screenshots->chunk(4) as $screenshotRow)
            <section class="screenshot-row">
                <div class="row">
                    @foreach ($screenshotRow as $screenshot)
                        <div class="col-md-3">
                                <div class="screenshot">
                                    <img data-toggle="modal" data-target="#screenshotModal" data-screenshot="{{ $screenshot->id }}" data-extension="{{ $screenshot->extension }}" src="/imagecache/medium/{{ $screenshot->id }}.{{ $screenshot->extension }}" />
                                </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endforeach
    </section>
</div>
@stop
