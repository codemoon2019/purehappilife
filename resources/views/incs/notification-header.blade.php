
                                   
                                   @foreach($data as $info)
                                    <a class="dropdown-item" href="javaScript:;">
										<div class="media align-items-center">
											<div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
											</div>
											<div class="media-body">
												<h6 class="msg-name">{{ $info->title }} <span class="msg-time float-right">{{ $info->created_at->diffForHumans() }}
													</span></h6>
												<p class="msg-info">{{ $info->description}}</p>
											</div>
										</div>
                                    </a>
                                    @endforeach