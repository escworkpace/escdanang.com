@extends('admin.admin_master')
@section('content_header')
	<section class="content-header">
	    <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb" style="left: 30px">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Legal Services</a></li>
        <li class="active">Simple</li>
      </ol>
	</section>
@stop
@section('content')
 <!-- Include CKEditor and jQuery adapter -->
<form id="profileForm" method="" class="form-horizontal" action="">
   {!! csrf_field() !!}
    <div class="form-group">
        <label class="col-xs-3 control-label">Full name</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="fullName" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Bio</label>
        <div class="col-xs-9">
            <textarea class="form-control" name="bio" style="height: 400px;"></textarea>
            <script>CKEDITOR.replace('bio');</script>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" class="btn btn-default">Validate</button>
        </div>
    </div>
</form>
@stop
@section('script')
<script src="//cdn.ckeditor.com/4.4.3/basic/ckeditor.js"></script>
<script src="//cdn.ckeditor.com/4.4.3/basic/adapters/jquery.js"></script>
<script>
$(document).ready(function() {
    $('#profileForm')
        .formValidation({
            framework: 'bootstrap',
            excluded: [':disabled'],
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                fullName: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required and cannot be empty'
                        }
                    }
                },
                bio: {
                    validators: {
                        notEmpty: {
                            message: 'The bio is required and cannot be empty'
                        },
                        callback: {
                            message: 'The bio must be less than 200 characters long',
                            callback: function(value, validator, $field) {
                                if (value === '') {
                                    return true;
                                }
                                // Get the plain text without HTML
                                var div  = $('<div/>').html(value).get(0),
                                    text = div.textContent || div.innerText;

                                return text.length <= 200;
                            }
                        }
                    }
                }
            }
        })
        .find('[name="bio"]')
            .ckeditor()
            .editor
                // To use the 'change' event, use CKEditor 4.2 or later
                .on('change', function() {
                    // Revalidate the bio field
                    $('#profileForm').formValidation('revalidateField', 'bio');
                });
});
</script>
@stop