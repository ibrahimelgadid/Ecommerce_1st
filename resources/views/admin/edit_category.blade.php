@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{URL::to('/dashboard')}}">Dashboard</a>
        <i class="icon-angle-right"></i> 
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">edit_category</a>
    </li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Category</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
        <form class="form-horizontal" method="POST" action="{{url('/update_category',$category->category_id)}}">
                @csrf
              <fieldset>
                
                <div class="control-group">
                  <label class="control-label" for="category name">Category Name</label>
                  <div class="controls">
                  <input type="text" class="input-xlarge " name="category_name" value="{{$category->category_name}}">
                  </div>
                </div>

                    
                <div class="control-group ">
                  <label class="control-label" for="category_description">Category Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name="category_description" rows="3">
                       {{ $category->category_description}}
                    </textarea>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Edit Category</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->


@endsection