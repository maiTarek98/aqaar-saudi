<div class="row">
                                    <!-- Buy X -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buy_x" class="form-label">Buy X (Optional)</label>
                                            <input type="number" class="form-control" id="buy_x" name="buy_x" min="0">
                                        </div>
                                    </div>
                                    <!-- Applicable Products -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buy_product_ids" class="form-label">Applicable Products</label>
                                            <select class="form-control" id="buy_product_ids" name="buy_product_ids[]" multiple required>
                                                @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Get Y -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="get_y" class="form-label">Get Y (Optional)</label>
                                            <input type="number" class="form-control" id="get_y" name="get_y" min="0">
                                        </div>
                                    </div>
                                    <!-- Applicable Products -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="get_product_ids" class="form-label">Applicable Products</label>
                                            <select class="form-control" id="get_product_ids" name="get_product_ids[]" multiple required>
                                                @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Discount Value -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="discount_value" class="form-label">Discount Value</label>
                                            <input type="number" class="form-control" id="discount_value" name="discount_value" step="0.01" min="0" required>
                                        </div>
                                    </div>
                                    <!-- Discount Type -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="discount_type" class="form-label">Discount Type</label>
                                            <select class="form-control" id="discount_type" name="discount_type" required>
                                                <option value="percentage">Percentage</option>
                                                <option value="fixed">Fixed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>