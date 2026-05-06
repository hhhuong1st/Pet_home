<?php
/**
 * The Template for displaying all single products
 */

get_header(); ?>
<div class="container mx-auto px-4 py-8 max-w-[1200px] font-sans">
    <?php while ( have_posts() ) : the_post(); 
        global $product;
    ?>
    <!-- Breadcrumb -->
    <?php pet_shop_breadcrumbs(); ?>

    <!-- Product Container -->
    <div class="flex flex-col md:flex-row gap-10 md:gap-14 bg-white rounded-2xl md:p-8">
        
        <!-- Cột trái: Hình ảnh -->
        <div class="w-full md:w-5/12 lg:w-4/12 flex-shrink-0 relative">
            <div class="sticky top-28">
                <style>
                    /* Ép ảnh sản phẩm nguyên bản của Woo ra giữa */
                    .woocommerce-product-gallery { margin: 0 auto !important; float: none !important; width: 100% !important; text-align: center; }
                    .woocommerce-product-gallery__wrapper { display: flex; justify-content: center; width: 100%; transition: none !important; }
                    .woocommerce-product-gallery__image { width: 100%; display: flex; justify-content: center; }
                    .woocommerce-product-gallery__image img { margin: 0 auto; display: block !important; max-height: 500px; width: auto !important; object-fit: contain; }
                    .flex-viewport { direction: ltr; }
                </style>
                <div class="rounded-2xl bg-white p-2 flex justify-center items-center" style="max-height: auto; min-height: 300px;">
                    <?php 
                        // Sử dụng hook hiển thị ảnh mặc định của WooCommerce để hỗ trợ slider và zoom chính chủ
                        do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                </div>
            </div>
        </div>

        <!-- Cột phải: Thông tin (Tương tự thiết kế yêu cầu) -->
        <div class="w-full md:w-7/12 lg:w-8/12 flex flex-col">
            <h1 class="text-2xl md:text-[26px] font-bold mb-3 text-[#8b3dff]" style="line-height: 1.4;">
                <?php the_title(); ?>
            </h1>
            
            <div class="flex items-center gap-2 mb-4">
                <?php 
                    $rating_count = $product->get_rating_count();
                    $review_count = $product->get_review_count();
                    $average      = $product->get_average_rating() ?: 5; // Fake 5 sao mặc định cho đẹp nếu chưa có
                ?>
                <div class="flex text-[#ff7a21] text-sm">
                    <?php for ($i=1; $i<=5; $i++) {
                        if ($i <= intval($average)) echo '<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                        else echo '<svg class="w-4 h-4 text-gray-200 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
                    } ?>
                </div>
                <span class="text-sm text-gray-600"><?php echo $review_count > 0 ? $review_count : '6'; ?> đánh giá</span>
            </div>

            <!-- Đoạn trích (Mô tả ngắn) -->
            <?php if ( $post->post_excerpt ) : ?>
                <div class="text-[13px] text-gray-600 leading-relaxed mb-4 border-b border-gray-100 pb-4">
                    <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt); ?>
                </div>
            <?php endif; ?>

            <!-- Thương hiệu -->
            <?php 
                $final_brand = '';
                $all_taxonomies = get_object_taxonomies('product', 'names');

                foreach ($all_taxonomies as $taxonomy) {
                    $terms = get_the_terms($post->ID, $taxonomy);
                    if (!empty($terms) && !is_wp_error($terms)) {
                        $tax_lower = strtolower($taxonomy);
                        if (strpos($tax_lower, 'brand') !== false || strpos($tax_lower, 'thuong') !== false || strpos($tax_lower, 'hieu') !== false || strpos($tax_lower, 'nhan') !== false) {
                            $final_brand = $terms[0]->name;
                        }
                    }
                }

                if (empty($final_brand)) {
                    $all_meta = get_post_custom($post->ID);
                    foreach ($all_meta as $key => $values) {
                        if (strpos(strtolower($key), 'brand') !== false || strpos(strtolower($key), 'thuong') !== false) {
                            $final_brand = $values[0];
                            break;
                        }
                    }
                }

                if (!empty($final_brand)) :
            ?>
                <div class="mb-4 text-[15px] text-gray-700 flex items-center">
                    <span class="text-gray-500 mr-2 w-28">Thương hiệu:</span> 
                    <span class="font-medium text-gray-900"><?php echo esc_html($final_brand); ?></span>
                </div>
            <?php endif; ?>

            <!-- Giá Tự Động -->
            <div class="text-[22px] font-bold text-gray-900 mb-2 flex items-end gap-3 mt-2 custom-main-price">
                <?php echo $product->get_price_html(); ?>
            </div>

            <!-- Inject WooCommerce Add to Cart Form (works for both simple and variable) -->
            <div class="custom-woo-form mt-2">
                <style>
                    /* Ẩn bớt các rác của woo */
                    .woocommerce-variation-price { display: none !important; }
                    .custom-woo-form .reset_variations { display: none !important; }
                    
                    /* Custom Variatons Table */
                    table.variations { border: none; width: 100%; margin-bottom: 1rem; }
                    table.variations tbody tr { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem; align-items: flex-start !important; }
                    table.variations th, table.variations td { border: none; padding: 0; display: block; text-align: left !important; line-height: 1; }
                    table.variations th.label, table.variations td.label { font-weight: 500 !important; color: #1f2937; font-size: 15px; text-transform: capitalize; margin: 0; display: flex; align-items: center; }
                    table.variations th.label label, table.variations td.label label { margin: 0; font-weight: 500 !important; font-size: 15px; }
                    
                    /* Dynamic value next to label */
                    .selected-value { font-weight: 400; color: #6b7280; margin-left: 4px; font-size: 15px; }

                    /* Custom Layout for buttons */
                    .swatch-group { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0; justify-content: flex-start; }
                    .swatch-btn { border: 1px solid #e5e7eb; border-radius: 4px; padding: 0.5rem 1.25rem; font-size: 14px; font-weight: 500; color: #1f2937; background: #fff; cursor: pointer; transition: all 0.2s; }
                    .swatch-btn:hover { border-color: #8b3dff; color: #8b3dff; }
                    .swatch-btn.active { border-color: #8b3dff; border-width: 2px; color: #8b3dff; padding: calc(0.5rem - 1px) calc(1.25rem - 1px); }
                    .swatch-btn.disabled { opacity: 0.4; cursor: not-allowed; text-decoration: line-through; }

                    /* Add to cart layout */
                    .woocommerce-variation-add-to-cart, form.cart:not(.variations_form) { display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; margin-top: 0; position: relative; }
                    
                    /* Thêm chữ Số lượng bằng CSS Pseudo-element để bù đắp cái default Woo thiếu */
                    .woocommerce-variation-add-to-cart::before, form.cart:not(.variations_form)::before {
                        content: "Số Lượng:";
                        display: block;
                        width: 100%;
                        font-weight: 500;
                        color: #1f2937;
                        font-size: 15px;
                        margin-bottom: 0.5rem;
                        text-align: left;
                        line-height: 1;
                    }

                    /* Quantity */
                    .custom-woo-form .quantity { display: flex !important; align-items: center; border: 1px solid #d1d5db; border-radius: 9999px; height: 48px; width: 130px; overflow: hidden; background: #fff; }
                    .custom-woo-form .quantity .qty { width: 50px; text-align: center; border: none !important; height: 100%; padding: 0; font-weight: 600; font-size: 16px; background: transparent !important; box-shadow: none !important; }
                    .custom-woo-form .quantity .qty::-webkit-outer-spin-button, .custom-woo-form .quantity .qty::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
                    .qty-btn { width: 40px; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 400; color: #6b7280; cursor: pointer; background: transparent; border: none; transition: background 0.2s; }
                    .qty-btn:hover { background: #f3f4f6; color: #111827; }

                    /* Submit button - Forcing intense color and removing all transparency/fading */
                    body .custom-woo-form button.single_add_to_cart_button.button,
                    body .custom-woo-form .quantity + button.single_add_to_cart_button.button,
                    body .custom-woo-form .woocommerce-variation-add-to-cart .single_add_to_cart_button.button { 
                        display: inline-flex !important;
                        flex: none !important;
                        width: auto !important;
                        min-width: 200px !important; 
                        background-color: #8b3dff !important; 
                        background: #8b3dff !important;
                        color: #ffffff !important; 
                        font-weight: 700 !important; 
                        font-size: 15px !important; 
                        height: 48px !important; 
                        padding: 0 35px !important; 
                        border-radius: 9999px !important; 
                        transition: all 0.2s ease-in-out !important; 
                        border: none !important; 
                        box-shadow: none !important; 
                        cursor: pointer !important; 
                        margin: 0 !important; 
                        opacity: 1 !important; 
                        filter: none !important;
                        align-items: center !important; 
                        justify-content: center !important; 
                    }
                    body .custom-woo-form button.single_add_to_cart_button.button:hover { 
                        background-color: #6a1edb !important; 
                        transform: scale(1.02) !important;
                    }
                    /* Overriding WooCommerce default disabled opacity */
                    .woocommerce-variation-add-to-cart-disabled .single_add_to_cart_button.button,
                    .single_add_to_cart_button.button.disabled,
                    .single_add_to_cart_button.button:disabled { 
                        opacity: 1 !important; 
                        background-color: #8b3dff !important; 
                        cursor: pointer !important; 
                    }
                </style>
                
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>

            <!-- Thông tin vận chuyển -->
            <div class="mt-8 space-y-4 border-b border-gray-100 pb-8">
                <div class="flex items-start gap-4">
                    <svg class="w-[22px] h-[22px] text-gray-700 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    <div>
                        <div class="font-medium text-[13px] text-gray-800 flex items-center mb-1">
                            Miễn Phí Vận Chuyển 
                            <span class="bg-gray-300 text-white text-[10px] w-[14px] h-[14px] inline-flex items-center justify-center rounded-full ml-1 cursor-pointer font-bold">?</span>
                        </div>
                        <div class="text-[12px] text-gray-500">Tối đa 30K cho đơn hàng từ 500K</div>
                        <div class="text-[12px] text-gray-500 mt-1">Hoả tốc 4h trong nội thành HCM</div>
                    </div>
                </div>
            </div>

            <!-- Social Share -->
            <div class="mt-6 flex items-center gap-4">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Chia sẻ Boss:</span>
                <div class="flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#1877F2] hover:text-white transition-all text-gray-500">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 3.656 10.954 8.719 12.073v-8.54h-3.102v-3.533h3.102V9.417c0-3.059 1.808-4.758 4.619-4.758 1.346 0 2.755.24 2.755.24v3.029h-1.551c-1.516 0-1.989.942-1.989 1.906v2.288h3.414l-.546 3.533h-2.868v8.54C20.344 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#1DA1F2] hover:text-white transition-all text-gray-500">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.95 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Tab Mô tả -->
    <div class="mt-12 bg-white rounded-2xl p-6 md:p-10 shadow-sm border border-gray-50 mb-10" id="tab-description">
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h2 class="text-xl md:text-[22px] font-bold text-[#8b3dff]">Mô tả sản phẩm</h2>
        </div>
        
        <div class="text-gray-700 leading-relaxed text-[15px] max-w-full">
            <?php 
                // Xuất nội dung thô có format chữ để ngăn chặn the_content() re-render giao diện Woo mặc định cũ
                $content = $post->post_content;
                echo wpautop(do_shortcode($content)); 
            ?>
        </div>
    </div>

    <?php endwhile; ?>
</div>

<script>
    // JS xử lý UI cho biến thể và số lượng
    document.addEventListener('DOMContentLoaded', function() {
        
        let currentPriceValue = <?php echo $product->get_price() ? floatval($product->get_price()) : 0; ?>;
        const curSymbol = "<?php echo get_woocommerce_currency_symbol(); ?>";

        function updateTotalPrice() {
            const qtyInput = document.querySelector('input.qty');
            if (!qtyInput) return;
            let qty = parseFloat(qtyInput.value) || 1;
            let total = qty * currentPriceValue;
            
            const mainPrice = document.querySelector('.custom-main-price');
            if (mainPrice && currentPriceValue > 0) {
                let formattedTotal = new Intl.NumberFormat('vi-VN').format(total);
                mainPrice.innerHTML = '<span class="woocommerce-Price-amount amount"><bdi>' + formattedTotal + '<span class="woocommerce-Price-currencySymbol"> ' + curSymbol + '</span></bdi></span>';
            }
        }

        // Lắng nghe thay đổi số lượng để gọi hàm tính
        document.body.addEventListener('change', function(e) {
            if(e.target && e.target.classList.contains('qty')) {
                updateTotalPrice();
            }
        });

        // 1. Convert Selects to Buttons
        const form = document.querySelector('.variations_form');
        if (form) {
            const selects = form.querySelectorAll('table.variations select');
            selects.forEach(select => {
                select.style.display = 'none'; // Hide default select
                const wrapper = document.createElement('div');
                wrapper.className = 'swatch-group';
                
                // Add event listener to standard WooCommerce variation forms to re-sync
                jQuery(form).on('woocommerce_update_variation_values', function() {
                    Array.from(wrapper.children).forEach(btn => {
                        const val = btn.dataset.value;
                        let option = Array.from(select.options).find(o => o.value === val);
                        if (!option) {
                            btn.style.display = 'none';
                        } else {
                            btn.style.display = 'block';
                            // WooCommerce might clear options or add disabled
                            if (option.disabled || option.className === 'disabled') {
                                btn.classList.add('disabled');
                            } else {
                                btn.classList.remove('disabled');
                            }
                        }
                    });
                });

                Array.from(select.options).forEach(option => {
                    if(option.value === '') return; 
                    
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'swatch-btn';
                    btn.innerText = option.text;
                    btn.dataset.value = option.value;
                    
                    btn.addEventListener('click', () => {
                        if (btn.classList.contains('disabled')) return;
                        
                        Array.from(wrapper.children).forEach(c => c.classList.remove('active'));
                        btn.classList.add('active');
                        
                        // Cập nhật text phụ kiện bên cạnh label Size
                        const tr = select.closest('tr');
                        if(tr) {
                            let valSpan = tr.querySelector('.selected-value');
                            if(!valSpan) {
                                const labelTd = tr.querySelector('th.label, td.label');
                                if(labelTd) {
                                    valSpan = document.createElement('span');
                                    valSpan.className = 'selected-value';
                                    labelTd.appendChild(valSpan);
                                }
                            }
                            if(valSpan) {
                                valSpan.innerText = ": " + option.text;
                            }
                        }
                        
                        select.value = option.value;
                        const event = new Event('change', { bubbles: true });
                        select.dispatchEvent(event);
                    });
                    wrapper.appendChild(btn);
                });
                select.parentNode.appendChild(wrapper);

                // Khởi tạo label nếu có nút active sẵn
                setTimeout(() => {
                    const activeBtn = Array.from(wrapper.children).find(b => b.dataset.value === select.value);
                    if (activeBtn) activeBtn.click();
                }, 100);
            });

            // Update main price dynamically when variation changes
            jQuery(form).on('found_variation', function(event, variation) {
                if (variation.display_price !== undefined) {
                    currentPriceValue = variation.display_price;
                }
                updateTotalPrice(); // Gọi cập nhật lại giao diện giá ngay
            });
        }

        // 2. Add Plus/Minus buttons to quantity fields
        function setupQuantities() {
            const quants = document.querySelectorAll('.quantity');
            quants.forEach(q => {
                if (q.querySelector('.qty-btn')) return; // already added

                const input = q.querySelector('input.qty');
                if (!input) return;

                const minusBtn = document.createElement('button');
                minusBtn.type = 'button';
                minusBtn.className = 'qty-btn';
                minusBtn.innerHTML = '−';

                const plusBtn = document.createElement('button');
                plusBtn.type = 'button';
                plusBtn.className = 'qty-btn';
                plusBtn.innerHTML = '+';

                q.insertBefore(minusBtn, input);
                q.appendChild(plusBtn);

                minusBtn.addEventListener('click', () => {
                    let val = parseFloat(input.value);
                    let min = parseFloat(input.min) || 1;
                    let step = parseFloat(input.step) || 1;
                    if (val > min) {
                        input.value = val - step;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });

                plusBtn.addEventListener('click', () => {
                    let val = parseFloat(input.value);
                    let max = parseFloat(input.max) || Infinity;
                    let step = parseFloat(input.step) || 1;
                    if (val < max) {
                        input.value = val + step;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        }
        setupQuantities();
        jQuery(document).on('updated_wc_div', setupQuantities);
    });
</script>

<?php get_footer(); ?>
