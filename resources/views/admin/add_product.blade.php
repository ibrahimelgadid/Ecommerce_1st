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
        <a href="{{URL::to('/add_product')}}">add_product</a>
    </li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
            <div class="box-icon">
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
        <form class="form-horizontal" method="POST" action="{{url('/save_product')}}" enctype="multipart/form-data">
                @csrf
              <fieldset>
                
                <div class="control-group">
                  <label class="control-label" for="product name">product Name</label>
                  <div class="controls">
                  <input type="text" class="input-xlarge " name="product_name">
                  </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="product name">product price</label>
                    <div class="controls">
                    <input type="text" class="input-xlarge " name="product_price">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="product color">product Color</label>
                    <div class="controls">
                    <input type="text" class="input-xlarge " name="product_color">
                    </div>
                  </div>

                  <div class="control-group">
                      <label class="control-label" for="product size">product Size</label>
                      <div class="controls">
                      <input type="text" class="input-xlarge " name="product_size">
                      </div>
                    </div>

                <div class="control-group">
                    <label class="control-label" for="fileInput">product Image</label>
                    <div class="controls">
                    <input type="file" class="input-file uniform-on" name="product_image" id="file-input">
                    </div>
                  </div>

                <div class="control-group">
                    <label class="control-label" for="selectError3">Category</label>
                    <div class="controls">
                      
                      <select id="selectError3" name="category_id">
                        <option>Select Category</option>
                        <?php 
                        foreach ($data['categories'] as $category) {?>
                         <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                        <?php }
                          ?>
                      </select>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="selectError3">Manufacture</label>
                    <div class="controls">
                      
                      <select id="selectError3" name='manufacture_id'>
                          <option>Select Manufacture</option>
                        <?php 
                        foreach ($data['manufactures'] as $manufacture) {?>
                         <option value="{{$manufacture->manufacture_id}}">{{$manufacture->manufacture_name}}</option>
                        <?php }
                          ?>
                      </select>
                    </div>
                </div>

                    
                <div class="control-group ">
                  <label class="control-label" for="product_description">product short Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name="product_short_description" rows="3"></textarea>
                  </div>
                </div>

                <div class="control-group ">
                    <label class="control-label" for="product_description">product long Description</label>
                    <div class="controls">
                      <textarea class="cleditor" name="product_long_description" rows="3"></textarea>
                    </div>
                  </div>

                <div class="control-group ">
                        <label class="control-label" for="publication_status">Publication Status</label>
                        <div class="controls">
                          <input type="checkbox" name="publication_status" value="1">
                        </div>
                      </div>


                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Add product</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->


@endsection