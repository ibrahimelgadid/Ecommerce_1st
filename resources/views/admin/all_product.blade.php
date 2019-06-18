@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
        <a href="{{URL::to('dashboard')}}">Dashboard</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="{{URL::to('all_product')}}">All product</a></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Products</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                  <thead>
                      <tr>
                          <th>product ID</th>
                          <th>product Name</th>
                          <th>product Description</th>
                          <th>product Image</th>
                          <th>product Price</th>
                          <th>Category Name</th>
                          <th>Manufacture Name</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>   
                  <tbody>
                      @if(count($products)>0)
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->product_id}}</td>
                                <td class="center">{{$product->product_name}}</td>
                                <td class="center">{{$product->product_long_description}}</td>
                                <td class="center">
                                    <img  style="height:100px;width:100px"
                                    src="{{$product->product_image}}" alt="{{$product->product_image}}">
                                </td>
                                <td class="center">{{$product->product_price}}</td>
                                <td class="center">{{$product->category_name}}</td>
                                <td class="center">{{$product->manufacture_name}}</td>
                                @if($product->publication_status ===1)
                                    <td class="center">
                                        <span class="label label-success">Active</span>
                                    </td>
                                @else
                                    <td class="center">
                                        <span class="label label-danger">Unactive</span>
                                    </td>
                                @endif
                                <td class="center">
                                    @if($product->publication_status == 1)
                                        <a class="btn btn-danger" href="{{URL::to('/unactive_product/'.$product->product_id)}}">
                                            <i class="halflings-icon white thumbs-down"></i>  
                                        </a>
                                    @else
                                        <a class="btn btn-success" href="{{URL::to('/active_product/'.$product->product_id)}}">
                                            <i class="halflings-icon white thumbs-up"></i>  
                                        </a>
                                    @endif
                                    <a class="btn btn-info" href="{{URL::to('/edit_product/'.$product->product_id)}}">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger delete" href="{{URL::to('/delete_product/'.$product->product_id)}}">
                                        <i class="halflings-icon white trash"></i> 
                                    </a>
                                </td>
                            </tr>
                            
                        @endforeach
                    @else
                        <p>no products</p>
                    @endif
                  </tbody>
              </table>            
            </div>
        </div><!--/span-->
    
    </div><!--/row-->
@endsection