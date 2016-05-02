@extends('layouts.default')

@section('main')
<div class="container">
  <div class="row">
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <div class="col-md-9">
      @if (isset($article))
      <form id="article-form" name="article-form" role="form" action="/blog/{{$article->id}}/update" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="field">Title:</label>
          <div class="input-group">
            <div class="input-group-btn">
              <button type="button" name="type" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$type}}<span class="caret"></span></button>
              <input type="hidden" name="article-type" id="article-type" value="">
              <input type="hidden" name="article-id" id="article-id" value="{{$article->id}}">
              <ul class="dropdown-menu">
                <li><a href="#" data-value="Original">Original</a></li>
                <li><a href="#" data-value="Reproduction">Reproduction</a></li>
                <li><a href="#" data-value="Translation">Translation</a></li>
              </ul>
              </div><!-- /btn-group -->
              <input type="text" name="title" value="{{$article->title}}" class="form-control" id="article-title">
            </div>
          </div>
          <div class="form-group">
            <label for="field">Content:</label>
            <!-- <div id="summernote"></div> -->
            <textarea name="summernote" class="form-control" id="summernote"></textarea>
            <script>
              $(document).ready(function() {
                  $('#summernote').summernote('code', '{!! $article->content !!}');
              })
            </script>
          </div>
          <div class="form-group">
            <label for="field-4">Tags:</label>
            <div class="input-group">
              <select class="form-control" name="tags" id="tags-selector">
                <option value="">Select one...</option>
                @if (isset($tags))
                  @foreach ($tags as $tag)
                  <option value="{{$tag->name}}" selected="{{ ($tag->name != $tagUsed[0]->name) ? : "selected"}}">{{$tag->name}}</option>
                  @endforeach
                @endif
              </select>
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" id="tag-add" data-toggle="modal" data-target="#tagModal"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>
              </span>
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-3">Privilege:</label>
            <div>
              <label class="checkbox-inline">
                <input type="checkbox" id="comment_permition" name="comment_permition" value="0" {{ ($article->comment_permition != 0) ? : "checked" }}> Disable comment
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="is_public" name="is_public" value="0" {{ ($article->is_public != 0) ? : "checked" }}> Private
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="reproduct_permition" name="reproduct_permition" value="0" {{ ($article->reproduct_permition != 0) ? : "checked" }}> Prohibit Reproduce
              </label>
            </div>
          </div>
          
          <div class="btn-toolbar" role="toolbar" aria-label="...">
            <div class="btn-group" role="group" aria-label="First">
              <button type="button" class="btn btn-info" id="preview-function" data-toggle="modal" data-target="#previewModal">Preview</button>
            </div>
            <div class="btn-group pull-right" role="group" aria-label="Second">
              <input type="submit" value="Submit" class="btn btn-info">
            </div>
          </div>
        @endif
        </form>
        <!-- preview Modal -->
        <div class="modal fade" id="previewModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="preview-title"></h4>
              </div>
              <div class="modal-body" id="preview-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /preview Modal -->
        <!-- Tag Add Modal -->
        <div class="modal fade" id="tagModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="tagadding-title"></h4>
              </div>
              <div class="modal-body" id="tagadding-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="add-tag-btn">Add</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /Tag Add Modal -->
        @if (count($errors) != 0)
          <div class="alert alert-danger alert-dismissible" role="alert" id="fail-alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>Oops! Something went wrong while submitting this article.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
  @stop