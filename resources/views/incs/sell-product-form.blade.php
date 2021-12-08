                <!--end breadcrumb-->
                <div class="card">
						<div class="card-header">Create new products</div>
						<div class="card-body">
                            <form action="/home/artist-create-product" id="create-product" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Name:</label>
                                            <input class="form-control validate-field" error-message="Product name is required" id="txtProductName" name="txtProductName" type="text" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="product-name">Product Description:</label>
                                            <textarea class="form-control ckeditor" id="txtProductDescription" name="txtProductDescription" placeholder="Message" rows="10" cols="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Selling Price:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">	
                                                </div>
                                                <input type="text" class="form-control  validate-field" id="txtProductOriginalPrice" name="txtProductOriginalPrice" error-message="Product original price is required" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">
                                                </div>
                                            </div>
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Product Original Price:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">	
                                                </div>
                                                <input type="text" class="form-control" id="txtProductRetailPrice" name="txtProductRetailPrice" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">	
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Product Stock:</label>
                                                <input type="text" class="form-control validate-field" error-message="Please specify the stock of this product" id="txtProductStock" name="txtProductStock" error-message="Please specify the stock of this product" aria-label="Amount (to the nearest dollar)">
                                                <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Primary Product Image:</label>
                                            <input class="form-control" id="txtProductPrimaryImage" name="txtProductPrimaryImage" error-message="Product image is required" type="file" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Lorikeet Image:</label>
                                            <input class="form-control" id="txtLorikeet" name="txtLorikeet" type="file" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Gift Points:</label>
                                            <input class="form-control" id="txtGiftPoints" name="txtGiftPoints" type="text" placeholder="Gift Points">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Addtional Product Image:</label>
                                            <input class="form-control" type="file" id="txtProductAdditionalImage" name="txtProductAdditionalImage[]" multiple>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">&nbsp</label>
                                            <button class="btn btn-success form-control btn-save-product">SAVE NEW PRODUCT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>