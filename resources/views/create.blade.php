@extends('layouts.default')
@section('main')
<div class="container">
  <div class="row">
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <div class="col-md-9">
      <form id="form" name="form" role="form">
        
        <div class="form-group">
          <label for="field">Title:</label>
          <div class="input-group">
            <div class="input-group-btn">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select one... <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="#" data-value="Original">Original</a></li>
                <li><a href="#" data-value="Reproduction">Reproduction</a></li>
                <li><a href="#" data-value="Translation">Translation</a></li>
              </ul>
              </div><!-- /btn-group -->
              <input type="text" placeholder="Enter your name" class="form-control" id="article-title">
            </div>
          </div>
          <div class="form-group">
            <label for="field">Content:</label>
            <textarea placeholder="Example Text" class="form-control" id="article-content" rows="20"></textarea>
          </div>
          <div class="form-group">
            <label for="field-4">Categories:</label>
            <select class="form-control">
              <option value="">Select one...</option>
              <option value="First">First Choice</option>
              <option value="Second">Second Choice</option>
              <option value="Third">Third Choice</option>
            </select>
          </div>
          <div class="form-group">
            <label for="field-2">Tags:</label>
            <input type="text" placeholder="Enter tag" class="form-control" required="required">
          </div>
          
          <div class="form-group">
            <label for="field-3">Privilege:</label>
            <div>
              <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Open comment
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="option2"> Private
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> Prohibit Reproduce
              </label>
            </div>
          </div>
          <div class="form-group">
            <label for="field">Summary:</label>
            <textarea placeholder="Summary" class="form-control" rows="5"></textarea>
          </div>
          <div class="btn-toolbar" role="toolbar" aria-label="...">
            <div class="btn-group" role="group" aria-label="First">
              <button type="button" class="btn btn-default" id="preview-function" data-toggle="modal" data-target="#previewModal">Preview</button>
            </div>
            <div class="btn-group" role="group" aria-label="Second">
              <input type="submit" value="Submit" class="btn btn-default">
            </div>
          </div>
        </form>


          <!-- Modal -->
  <div class="modal fade" id="previewModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
          </div>
        </div>
      </div>
        <div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p>Well done! You have posted an article successfully!</p>
        </div>
        <div class="alert alert-danger alert-dismissible" role="alert" id="fail-alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <p>Oops! Something went wrong while submitting this article.</p>
        </div>
      </div>
    </div>
  </div>
  @stop