<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                    <?php 
                            $sliders = DB::table('tbl_slider')
                            ->where('publication_status',1)
                            ->get();
                        ?>
                    <ol class="carousel-indicators">
                            @foreach( $sliders as $slider )
                                <li data-target="#slider-carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                    
                    <div class="carousel-inner">
                        
                        @foreach ($sliders as $slider)
                            
                        
                        <div class="item  @if ($loop->first) active @endif">
                            
                            <div class="col-sm-12">
                                <img src="{{URL::to($slider->slider_image)}}" class="girl img-responsive" alt="" style="height: 400px" />
                                <img src="{{URL::to('frontend/images/home/pricing.png')}}"  class="pricing" alt="" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section><!--/slider-->