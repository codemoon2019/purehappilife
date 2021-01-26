                            
                                
                               @foreach($data as $info)
                                <a href="#">  
                                <!-- timeline item 3 -->
                                    <div class="row">
                                        <div class="col-auto text-center flex-column d-none d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <span class="badge badge-pill bg-light border">&nbsp;</span>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="col py-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="float-right text-muted">{{ $info->created_at->diffForHumans() }}</div>
                                                    <h4 class="card-title">{{ $info->title }}</h4>
                                                    <p>{{ $info->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                </a>
                                @endforeach

                                {!! $data->links() !!}

                                