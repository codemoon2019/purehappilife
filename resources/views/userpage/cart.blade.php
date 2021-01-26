@include('incs.header')

@yield('section')
    <!-- bread crumb start -->
    <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
   </nav>
  <!--cart-section satrt -->
  <section class="whish-list-section pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="title text-capitalize">Your cart items</h3>
                    <div class="table-responsive pt-4">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" scope="col">Product Image</th>
                                    <th class="text-center" scope="col">Product Name</th>
                                    <th class="text-center" scope="col">Stock Status</th>
                                    <th class="text-center" scope="col">Qty</th>
                                    <th class="text-center" scope="col">Price</th>
                                    <th class="text-center" scope="col">action</th>
                                    <th class="text-center" scope="col">Checkout</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center" scope="row">
                                        <img src="assets/img/product/05.1.jpg" alt="img">
                                    </th>
                                    <td class="text-center">
                                        <span class="whish-title">Water and Wind Resistant</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary cb4">In Stock</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="product-count style">
                                            <div class="count d-flex justify-content-center">
                                                <input type="number" min="1" max="10" step="1" value="1">
                                                <div class="button-group">
                                                    <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>
                                                    <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="product-price">
                                        $38.24
                                      </span></td>

                                    <td class="text-center">
                                        <a href="#"> <span class="trash"><i class="fas fa-trash-alt"></i> </span></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-dark3">buy now</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">
                                        <img src="assets/img/product/05.jpg" alt="img">
                                    </th>
                                    <td class="text-center">
                                        <span class="whish-title">Originals Kaval Windbreaker</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary cb4">In Stock</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="product-count style">
                                            <div class="count d-flex justify-content-center">
                                                <input type="number" min="1" max="10" step="1" value="1">
                                                <div class="button-group">
                                                    <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>
                                                    <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="product-price">
                                        $38.24
                                      </span></td>

                                    <td class="text-center">
                                        <a href="#"> <span class="trash"><i class="fas fa-trash-alt"></i> </span></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-dark3">buy now</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">
                                        <img src="assets/img/product/1.1.jpg" alt="img">

                                    </th>
                                    <td class="text-center">
                                        <span class="whish-title">New Balance Arishi</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary cb4">In Stock</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="product-count style">
                                            <div class="count d-flex justify-content-center">
                                                <input type="number" min="1" max="10" step="1" value="1">
                                                <div class="button-group">
                                                    <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>
                                                    <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="product-price">
                                        $38.24
                                      </span></td>

                                    <td class="text-center">
                                        <a href="#"> <span class="trash"><i class="fas fa-trash-alt"></i> </span></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-dark3">buy now</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart-section end -->

@include('incs.footer')

