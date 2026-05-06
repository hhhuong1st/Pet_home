<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
    // Tối ưu Meta Description động
    $meta_description = 'Phòng khám thú y & Pet Shop. Cung cấp thức ăn, phụ kiện, dịch vụ chăm sóc thú cưng uy tín, chất lượng nhất.';
    if ( is_single() || is_page() ) {
        $meta_description = wp_trim_words(get_the_excerpt(), 25);
    } elseif ( is_category() || is_tax() ) {
        $meta_description = wp_trim_words(term_description(), 25);
    }
    ?>
    <meta name="description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url( (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ); ?>">

    <!-- Google Search Console (Thay mã xác minh của bạn vào đây) -->
    <meta name="google-site-verification" content="YOUR_GSC_VERIFICATION_CODE_HERE" />

    <!-- Google Analytics (GA4) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-XXXXXXXXXX');
    </script> -->

    <!-- Schema Markup (Dữ liệu cấu trúc JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "<?php echo home_url('/'); ?>",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "<?php echo home_url('/'); ?>?s={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Pet Shop & Veterinary Center",
      "image": "<?php echo get_template_directory_uri(); ?>/images/logo.png",
      "@id": "<?php echo home_url('/'); ?>",
      "url": "<?php echo home_url('/'); ?>",
      "telephone": "1800 1060",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "123 Đường Pets, Cầu Giấy",
        "addressLocality": "Hà Nội",
        "addressCountry": "VN"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "08:00",
        "closes": "21:00"
      },
      "sameAs": [
        "https://www.facebook.com/petshop",
        "https://www.instagram.com/petshop"
      ]
    }
    </script>

    <!-- Thẻ Open Graph (Chuẩn SEO Facebook, Zalo, mạng xã hội) -->
    <meta property="og:title" content="<?php echo wp_get_document_title(); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(add_query_arg(array(), $wp->request)); ?>">
    <meta property="og:image" content="<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : get_template_directory_uri() . '/images/logo.png'; ?>">
    
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tùy chỉnh một số hình dạng đặc biệt trong thiết kế */
        .blob-shape {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }
        body { background-color: #ffffff; } /* Màu nền trắng */
        /* Phục hồi định dạng văn bản trong tab Mô tả sản phẩm & Bài viết */
        #tab-description h2, .hentry h2 { font-size: 1.8rem; font-weight: bold; color: #8b3dff; margin: 1.5rem 0 1rem; }
        #tab-description h3, .hentry h3 { font-size: 1.4rem; font-weight: bold; color: #ff7a21; margin: 1.2rem 0 0.8rem; }
        #tab-description ul, .hentry ul { list-style-type: disc; padding-left: 2rem; margin-bottom: 1rem; }
        #tab-description p, .hentry p { margin-bottom: 1rem; line-height: 1.7; }
        
        /* Hiệu ứng cho đường Link */
        #tab-description a, .hentry a, .prose a { color: #8b3dff; text-decoration: underline; font-weight: 700; transition: all 0.3s ease; }
        #tab-description a:hover, .hentry a:hover, .prose a:hover { color: #ff7a21; text-decoration: none; }
        
        /* Chỉnh sửa giao diện Bình luận mặc định của WP */
        ol.comment-list { list-style: none; padding: 0; margin: 0; }
        ol.comment-list li.comment { border-bottom: 1px solid #f3f4f6; padding-bottom: 2rem; margin-bottom: 2rem; }
        ol.comment-list li.comment:last-child { border-bottom: none; }
        .comment-body { display: flex; flex-direction: column; }
        @media (min-width: 640px) { .comment-body { flex-direction: row; gap: 1.5rem; } }

        /* Sửa lỗi hiển thị địa chỉ trong trang Tài khoản & Đơn hàng */
        .woocommerce-Addresses, 
        .woocommerce-columns--addresses,
        .woocommerce-customer-details .woocommerce-columns {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 2rem !important;
            margin: 2rem 0 !important;
            width: 100% !important;
        }
        .woocommerce-Addresses .woocommerce-Address,
        .woocommerce-columns--addresses .woocommerce-column,
        .woocommerce-customer-details .woocommerce-column {
            flex: 1 !important;
            min-width: 300px !important;
            padding: 2.5rem !important;
            background: #fff !important;
            border-radius: 2rem !important;
            border: 1px solid #f1f5f9 !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05) !important;
            transition: all 0.3s ease !important;
        }
        .woocommerce-Address:hover,
        .woocommerce-column:hover {
            border-color: #8b3dff !important;
            transform: translateY(-5px) !important;
            box-shadow: 0 20px 25px -5px rgba(139, 61, 255, 0.1) !important;
        }
        .woocommerce-Address header,
        .woocommerce-column h2,
        .woocommerce-column h3 {
            border-bottom: 2px solid #fff1e7 !important;
            padding-bottom: 1rem !important;
            margin-bottom: 1.5rem !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            font-size: 1.25rem !important;
            font-weight: 900 !important;
            color: #1e293b !important;
            font-family: 'Dancing Script', cursive;
        }
        .woocommerce-Address address,
        .woocommerce-column address {
            font-style: normal !important;
            line-height: 2 !important;
            color: #64748b !important;
            font-weight: 500 !important;
            white-space: normal !important;
            word-break: break-word !important;
            display: block !important;
        }
        .woocommerce-Address .edit {
            color: #8b3dff !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            font-size: 0.75rem !important;
            letter-spacing: 0.05em !important;
        }

        /* Tối ưu hiển thị bảng (Table) trên Mobile & Tablet (iPad) cho WooCommerce */
        @media screen and (max-width: 1024px) {
            .woocommerce table.shop_table_responsive thead,
            .woocommerce-page table.shop_table_responsive thead {
                display: none !important;
            }
            .woocommerce table.shop_table_responsive tr,
            .woocommerce-page table.shop_table_responsive tr {
                display: block !important;
                margin-bottom: 2rem !important;
                border: 1px solid #f1f5f9 !important;
                border-radius: 2rem !important;
                padding: 1.5rem !important;
                background: #fff !important;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05) !important;
                overflow: hidden !important;
            }
            .woocommerce table.shop_table_responsive td,
            .woocommerce-page table.shop_table_responsive td {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                text-align: right !important;
                border-bottom: 1px solid #f8fafc !important;
                padding: 1rem 0 !important;
                font-size: 0.9rem !important;
            }
            .woocommerce table.shop_table_responsive td:last-child,
            .woocommerce-page table.shop_table_responsive td:last-child {
                border-bottom: none !important;
            }
            .woocommerce table.shop_table_responsive td::before,
            .woocommerce-page table.shop_table_responsive td::before {
                content: attr(data-title) ": " !important;
                font-weight: 800 !important;
                color: #1e293b !important;
                text-transform: uppercase !important;
                font-size: 0.7rem !important;
                letter-spacing: 0.05em !important;
                flex-shrink: 0 !important;
                margin-right: 1rem !important;
                text-align: left !important;
            }
            
            /* Tinh chỉnh cho trang Đơn hàng */
            .woocommerce-orders-table__cell-order-actions {
                justify-content: center !important;
                gap: 0.5rem !important;
                padding-top: 1.5rem !important;
            }
            .woocommerce-orders-table__cell-order-actions::before {
                display: none !important;
            }
            .woocommerce-orders-table__cell-order-actions .button {
                margin: 0 !important;
                width: 100% !important;
                text-align: center !important;
                border-radius: 1rem !important;
            }
        }

        .comment-author.vcard { flex-shrink: 0; text-align: center; margin-bottom: 1rem; }
        .comment-author.vcard img { border-radius: 50%; width: 56px; height: 56px; border: 2px solid white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: inline-block; }
        .comment-author.vcard cite { font-style: normal; font-weight: 700; color: #1f2937; display: block; margin-top: 0.5rem; }
        .comment-meta { font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem; }
        .comment-meta a { color: #8b3dff; text-decoration: none; font-weight: 500; }
        .comment-content { color: #4b5563; line-height: 1.6; background: #fafafa; padding: 1.5rem; border-radius: 1.5rem; border: 1px solid #f3f4f6; position: relative; }
        .reply a { display: inline-flex; align-items: center; justify-content: center; margin-top: 1rem; font-size: 0.875rem; color: #ff7a21; font-weight: 700; background: #fff1eb; padding: 0.5rem 1rem; border-radius: 9999px; transition: all 0.2s; text-decoration: none; }
        .reply a:hover { background: #ff7a21; color: white; transform: translateY(-1px); }
        ul.children { list-style: none; padding-left: 2rem; margin-top: 2rem; border-left: 2px dashed #e5e7eb; }
        /* Fix sticky header offset khi có WordPress Admin Bar */
        .admin-bar header.sticky { top: 32px; }
        @media screen and (max-width: 782px) { .admin-bar header.sticky { top: 46px; } }
        /* Chỉnh sửa giao diện Tài khoản (My Account) WooCommerce */
        .woocommerce-account .woocommerce {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 0;
        }
        @media (min-width: 768px) {
            .woocommerce-account .woocommerce {
                flex-direction: row;
                gap: 3rem;
            }
        }
        .woocommerce-account .woocommerce-MyAccount-navigation {
            flex-shrink: 0;
            width: 100%;
        }
        @media (min-width: 768px) {
            .woocommerce-account .woocommerce-MyAccount-navigation {
                width: 280px;
            }
        }
        .woocommerce-account .woocommerce-MyAccount-navigation ul {
            list-style: none;
            padding: 0;
            margin: 0;
            background: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            overflow: hidden;
            border: 1px solid #f3f4f6;
        }
        .woocommerce-account .woocommerce-MyAccount-navigation ul li {
            border-bottom: 1px solid #f3f4f6;
        }
        .woocommerce-account .woocommerce-MyAccount-navigation ul li:last-child {
            border-bottom: none;
        }
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a {
            display: block;
            padding: 1.25rem 1.5rem;
            color: #4b5563;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-size: 1.05rem;
        }
        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover {
            background: #fff6ef;
            color: #ff7a21;
            border-left-color: #ff7a21;
            padding-left: 1.75rem;
        }
        .woocommerce-account .woocommerce-MyAccount-content {
            flex-grow: 1;
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid #f3f4f6;
            min-height: 400px;
        }
        .woocommerce-account .woocommerce-MyAccount-content p {
            color: #4b5563;
            line-height: 1.7;
            margin-bottom: 1rem;
        }
        .woocommerce-account .woocommerce-MyAccount-content a {
            color: #8b3dff;
            font-weight: 600;
            text-decoration: none;
        }
        .woocommerce-account .woocommerce-MyAccount-content a:hover {
            color: #ff7a21;
            text-decoration: underline;
        }
        /* My Account Buttons */
        .woocommerce-account .button {
            background: #8b3dff;
            color: #ffffff;
            padding: 0.85rem 2rem;
            border-radius: 9999px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            justify-content: center;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(139,61,255,0.2);
        }
        .woocommerce-account .button:hover {
            background: #ff7a21;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255,122,33,0.3);
            color: #ffffff;
        }
        /* Login / Register Forms */
        .woocommerce-account .u-columns {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
        }
        @media (min-width: 768px) {
            .woocommerce-account .u-columns {
                flex-direction: row;
            }
            .woocommerce-account .u-column1,
            .woocommerce-account .u-column2 {
                width: 50%;
            }
        }
        .woocommerce-account form.login,
        .woocommerce-account form.register {
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid #f3f4f6;
            margin: 0;
        }
        .woocommerce-account h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        .woocommerce-account h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 4px;
            background: #ff7a21;
            border-radius: 2px;
        }
        .woocommerce-account .form-row {
            margin-bottom: 1.5rem;
        }
        .woocommerce-account label {
            display: block;
            font-weight: 700;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }
        .woocommerce-account .input-text {
            width: 100%;
            padding: 0.85rem 1.2rem;
            border: 2px solid #e5e7eb;
            border-radius: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            font-size: 1rem;
            color: #1f2937;
        }
        .woocommerce-account .input-text:focus {
            outline: none;
            border-color: #8b3dff;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(139,61,255,0.1);
        }
        .woocommerce-account .woocommerce-form-login__submit,
        .woocommerce-account .woocommerce-form-register__submit {
            width: 100%;
            margin-top: 1rem;
            font-size: 1.1rem;
        }
        /* Tables in My Account */
        .woocommerce-account table.shop_table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 1.5rem;
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
        .woocommerce-account table.shop_table th {
            background: #f9fafb;
            padding: 1.2rem 1rem;
            text-align: left;
            font-weight: 800;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }
        .woocommerce-account table.shop_table td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            color: #4b5563;
            vertical-align: middle;
        }
        .woocommerce-account table.shop_table tr:last-child td {
            border-bottom: none;
        }
        .woocommerce-account table.shop_table tr:hover td {
            background: #fafafa;
        }
        .woocommerce-account .woocommerce-orders-table__cell-order-actions .button {
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
            background: #fff1eb;
            color: #ff7a21;
            box-shadow: none;
        }
        .woocommerce-account .woocommerce-orders-table__cell-order-actions .button:hover {
            background: #ff7a21;
            color: #ffffff;
            transform: translateY(-1px);
        }
        
        /* Message / Notice */
        .woocommerce-account .woocommerce-message,
        .woocommerce-account .woocommerce-info,
        .woocommerce-account .woocommerce-error {
            background: #f9fafb;
            border-radius: 1rem;
            padding: 1.2rem 1.5rem 1.2rem 3.5rem;
            border-left: 4px solid #8b3dff;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: relative;
        }
        .woocommerce-account .woocommerce-message::before,
        .woocommerce-account .woocommerce-info::before,
        .woocommerce-account .woocommerce-error::before {
            position: absolute;
            left: 1.2rem;
            top: 1.2rem;
        }
        .woocommerce-account .woocommerce-error {
            border-left-color: #ef4444;
            color: #b91c1c;
        }
        .woocommerce-account .woocommerce-info {
            border-left-color: #3b82f6;
        }
        .woocommerce-account .woocommerce-message .button,
        .woocommerce-account .woocommerce-info .button,
        .woocommerce-account .woocommerce-error .button {
            float: right;
            margin-left: 1rem;
            padding: 0.5rem 1.2rem;
            font-size: 0.9rem;
            margin-top: -0.3rem;
        }
        /* Clearfix cho notices để float button không bị lỗi */
        .woocommerce-account .woocommerce-message::after,
        .woocommerce-account .woocommerce-info::after,
        .woocommerce-account .woocommerce-error::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Tùy chỉnh Trang Thanh Toán (Checkout) */
        /* Hỗ trợ Classic Checkout */
        .woocommerce-checkout .woocommerce {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            max-w: 1200px;
            margin: 0 auto;
        }
        .woocommerce-checkout form.checkout {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            width: 100%;
        }
        .woocommerce-checkout #customer_details {
            flex: 1 1 60%;
            background: #fff;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
            border: 1px solid #f3f4f6;
        }
        .woocommerce-checkout #order_review_heading {
            display: none;
        }
        .woocommerce-checkout #order_review {
            flex: 1 1 35%;
            background: #fff;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px -10px rgba(139,61,255,0.1);
            border: 2px solid #f3e8ff;
            height: fit-content;
            position: sticky;
            top: 100px;
        }
        
        /* Hỗ trợ WooCommerce Block Checkout (Gutenberg) */
        .wp-block-woocommerce-checkout {
            max-width: 1200px;
            margin: 0 auto;
        }
        .wc-block-checkout__main {
            background: #fff !important;
            padding: 2rem !important;
            border-radius: 1.5rem !important;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08) !important;
            border: 1px solid #f3f4f6 !important;
        }
        .wc-block-checkout__sidebar {
            background: #fff !important;
            padding: 2rem !important;
            border-radius: 1.5rem !important;
            box-shadow: 0 10px 40px -10px rgba(139,61,255,0.1) !important;
            border: 2px solid #f3e8ff !important;
        }
        .wc-block-components-checkout-place-order-button {
            width: 100% !important;
            background: linear-gradient(135deg, #8b3dff, #ff7a21) !important;
            color: #fff !important;
            padding: 1.25rem !important;
            font-size: 1.2rem !important;
            font-weight: 800 !important;
            border-radius: 1rem !important;
            border: none !important;
            text-transform: uppercase !important;
            box-shadow: 0 10px 20px -5px rgba(139,61,255,0.4) !important;
            transition: all 0.3s !important;
            margin-top: 1rem !important;
            justify-content: center !important;
        }
        .wc-block-components-checkout-place-order-button:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 15px 25px -5px rgba(139,61,255,0.5) !important;
        }
        /* Style cho options vận chuyển/thanh toán trong Block */
        .wc-block-components-radio-control-accordion-option,
        .wc-block-components-radio-control__option {
            border: 2px solid #f3f4f6 !important;
            border-radius: 0.75rem !important;
            margin-bottom: 0.5rem !important;
            padding: 1rem 1rem 1rem 3rem !important; /* Tăng padding trái để tránh dính chữ */
            transition: all 0.3s ease !important;
            position: relative !important;
        }
        .wc-block-components-radio-control-accordion-option[data-selected="true"],
        .wc-block-components-radio-control__option:has(input:checked) {
            border-color: #8b3dff !important;
            background: #fdfafr !important; /* Tím nhạt */
            box-shadow: 0 4px 15px -3px rgba(139,61,255,0.15) !important;
        }
        .wc-block-components-radio-control__input {
            position: absolute !important;
            left: 1rem !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            margin: 0 !important;
        }

        /* Tùy chỉnh Trang Cảm Ơn (Order Received) */
        .woocommerce-order {
            max-width: 900px;
            margin: 3rem auto;
            background: #fff;
            padding: 3rem;
            border-radius: 1.5rem;
            box-shadow: 0 20px 50px -10px rgba(0,0,0,0.08);
            border: 1px solid #f3f4f6;
        }
        .woocommerce-order > p.woocommerce-notice,
        .woocommerce-order > p.woocommerce-thankyou-order-received {
            font-size: 1.5rem;
            font-weight: 800;
            color: #10b981; /* Xanh lá cây báo thành công */
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 2px dashed #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        .woocommerce-order > p.woocommerce-notice::before,
        .woocommerce-order > p.woocommerce-thankyou-order-received::before {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            background: #d1fae5;
            color: #059669;
            border-radius: 50%;
            font-size: 2rem;
        }
        .woocommerce-order ul.woocommerce-thankyou-order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            padding: 0;
            margin: 0 0 3rem 0;
            list-style: none;
        }
        /* Loại bỏ pseudo-elements rỗng làm hỏng lưới (Grid) của WooCommerce */
        .woocommerce-order ul.woocommerce-thankyou-order-details::before,
        .woocommerce-order ul.woocommerce-thankyou-order-details::after {
            display: none !important;
            content: none !important;
        }
        .woocommerce-order ul.woocommerce-thankyou-order-details li {
            background: #f9fafb !important;
            padding: 1.5rem !important;
            margin: 0 !important;
            border-radius: 1rem !important;
            border: 1px solid #f3f4f6 !important;
            text-align: center !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            font-size: 0.8rem !important;
            color: #6b7280 !important;
            text-transform: uppercase !important;
            font-weight: 600 !important;
            float: none !important;
        }
        .woocommerce-order ul.woocommerce-thankyou-order-details li strong {
            display: block;
            margin-top: 0.5rem;
            font-size: 1.1rem;
            color: #8b3dff;
            font-weight: 800;
            text-transform: none;
        }
        .woocommerce-order h2 {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: #111827;
        }
        .woocommerce-table--order-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3rem;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .woocommerce-table--order-details th,
        .woocommerce-table--order-details td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }
        .woocommerce-table--order-details thead th {
            background: #f9fafb;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            color: #6b7280;
        }
        .woocommerce-table--order-details tbody td.woocommerce-table__product-name a {
            color: #1f2937;
            font-weight: 600;
            text-decoration: none;
        }
        .woocommerce-table--order-details tbody td.woocommerce-table__product-total {
            font-weight: 700;
            color: #4b5563;
        }
        .woocommerce-table--order-details tfoot th {
            background: #fdfafr;
            font-weight: 600;
            text-align: right;
            padding-right: 2rem;
        }
        .woocommerce-table--order-details tfoot td {
            background: #fdfafr;
            font-weight: 800;
            color: #ff7a21;
        }
        .woocommerce-customer-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 1rem;
        }
        .woocommerce-customer-details .woocommerce-column {
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        }
        .woocommerce-customer-details h2.woocommerce-column__title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f3e8ff;
        }
        .woocommerce-customer-details address {
            font-style: normal;
            line-height: 1.8;
            color: #4b5563;
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }
        @media (max-width: 768px) {
            .woocommerce-order { padding: 1.5rem; margin: 1.5rem; }
            .woocommerce-customer-details { grid-template-columns: 1fr; gap: 1rem; }
        }
        /* Custom YITH Wishlist Button */
        .yith-custom-wrapper {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 20;
        }
        .yith-custom-wrapper .yith-wcwl-add-to-wishlist {
            margin-top: 0;
        }
        .yith-custom-wrapper .yith-wcwl-add-button > a,
        .yith-custom-wrapper .yith-wcwl-wishlistaddedbrowse > a,
        .yith-custom-wrapper .yith-wcwl-wishlistexistsbrowse > a,
        .yith-custom-wrapper .yith-wcwl-remove-button > a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            border: 1px solid #f3f4f6;
            border-radius: 0.75rem;
            color: #9ca3af;
            text-decoration: none;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            font-size: 1.1rem;
        }
        .yith-custom-wrapper .yith-wcwl-add-button > a:hover,
        .yith-custom-wrapper .yith-wcwl-add-button > a:hover i,
        .yith-custom-wrapper .yith-wcwl-add-button > a:hover svg,
        .yith-custom-wrapper .yith-wcwl-add-button > a:hover svg path {
            background-color: #fdf2f8;
            color: #ef4444 !important;
            fill: #ef4444 !important;
            stroke: #ef4444 !important;
        }
        .yith-custom-wrapper .yith-wcwl-wishlistaddedbrowse > a,
        .yith-custom-wrapper .yith-wcwl-wishlistexistsbrowse > a,
        .yith-custom-wrapper .yith-wcwl-remove-button > a,
        .yith-custom-wrapper .yith-wcwl-wishlistaddedbrowse > a i,
        .yith-custom-wrapper .yith-wcwl-wishlistexistsbrowse > a i,
        .yith-custom-wrapper .yith-wcwl-remove-button > a i,
        .yith-custom-wrapper .yith-wcwl-wishlistaddedbrowse > a svg,
        .yith-custom-wrapper .yith-wcwl-wishlistexistsbrowse > a svg,
        .yith-custom-wrapper .yith-wcwl-remove-button > a svg,
        .yith-custom-wrapper .yith-wcwl-wishlistaddedbrowse > a svg path,
        .yith-custom-wrapper .yith-wcwl-wishlistexistsbrowse > a svg path,
        .yith-custom-wrapper .yith-wcwl-remove-button > a svg path {
            color: #ef4444 !important;
            fill: #ef4444 !important;
            stroke: #ef4444 !important;
        }
        .yith-custom-wrapper i,
        .yith-custom-wrapper svg {
            margin-right: 0 !important;
            color: inherit;
        }
        /* Ẩn popup thông báo khó chịu của YITH */
        #yith-wcwl-popup-message,
        .yith-wcwl-popup-message {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
        }
        .yith-custom-wrapper span.feedback {
            display: none !important;
        }
        .yith-custom-wrapper a span {
            display: none !important; /* Ẩn chữ "Add to wishlist" */
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('text-gray-800 font-sans min-h-screen'); ?>>

<header class="sticky top-0 z-[9999] w-full bg-white shadow-sm">
    <div class="bg-white py-2 md:py-4 px-4 md:px-8 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4 relative z-[100]">
        <a href="<?php echo home_url('/'); ?>" class="flex items-center hover:opacity-80 transition-opacity" style="height: 60px; md:height: 80px;">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Pet Shop Logo" class="h-[50px] md:h-[80px] w-auto object-contain relative z-10">
            <div style="height: 80px; display: flex; align-items: center; margin-left: -25px; margin-right: 15px;">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo_1.png" alt="Pet Home Text Logo" style="height: 250px; width: auto; max-width: none; object-fit: contain;">
            </div>
        </a>

        <form action="<?php echo home_url('/'); ?>" method="get" class="flex-1 max-w-2xl w-full relative group">
            <input type="hidden" name="post_type" value="product">
            <?php 
                $header_search_val = (is_search() && isset($_GET['post_type']) && $_GET['post_type'] == 'product') ? get_search_query() : '';
            ?>
            <input type="text" name="s" id="header-search-input" value="<?php echo esc_attr($header_search_val); ?>" placeholder="Tìm kiếm sản phẩm..." class="w-full bg-gray-100 text-gray-700 rounded-full py-3 px-6 pr-24 focus:outline-none focus:ring-2 focus:ring-[#8b3dff] transition-all">
            
            <div class="absolute right-2 top-1/2 -translate-y-1/2 flex items-center gap-3">
                <!-- Nút X (Clear) -->
                <button type="button" id="clear-header-search" class="text-gray-400 hover:text-red-500 transition-colors <?php echo empty($header_search_val) ? 'hidden' : ''; ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                
                <!-- Nút Tìm kiếm -->
                <button type="submit" class="bg-[#8b3dff] text-white rounded-full w-10 h-10 flex items-center justify-center hover:bg-purple-700 transition shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
        </form>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hInput = document.getElementById('header-search-input');
            const hClearBtn = document.getElementById('clear-header-search');
            if (hInput && hClearBtn) {
                hInput.addEventListener('input', function() {
                    if (this.value.length > 0) hClearBtn.classList.remove('hidden');
                    else hClearBtn.classList.add('hidden');
                });
                hClearBtn.addEventListener('click', function() {
                    hInput.value = '';
                    hClearBtn.classList.add('hidden');
                    hInput.focus();
                });
            }
        });
        </script>

        <div class="flex items-center space-x-8">
            <div class="flex items-center space-x-3 hidden lg:flex">
                <div class="text-orange-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <div class="font-bold text-sm">Giao Hàng Miễn Phí</div>
                    <div class="text-gray-400 text-xs">Phạm vi toàn quốc</div>
                </div>
            </div>
            <div class="flex items-center space-x-3 hidden lg:flex">
                <div class="text-orange-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <div class="font-bold text-sm">Cam Kết Chính Hãng</div>
                    <div class="text-gray-400 text-xs">Đổi trả 30 ngày</div>
                </div>
            </div>
            <!-- Nút Yêu thích -->
            <a href="<?php echo function_exists('YITH_WCWL') ? esc_url( YITH_WCWL()->get_wishlist_url() ) : '#'; ?>" class="text-gray-600 hover:text-[#ff7a21] transition relative flex items-center" title="Yêu thích">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full yith-wcwl-items-count">
                    <?php echo function_exists('yith_wcwl_count_all_products') ? esc_html( yith_wcwl_count_all_products() ) : '0'; ?>
                </span>
            </a>

            <!-- Tài khoản (Đăng nhập / Đăng ký) -->
            <div class="relative group z-[100]">
                <a href="<?php echo class_exists('WooCommerce') ? get_permalink(get_option('woocommerce_myaccount_page_id')) : wp_login_url(); ?>" class="text-gray-600 hover:text-[#ff7a21] transition flex items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
                <div class="absolute left-1/2 -translate-x-1/2 top-full pt-2 w-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top scale-95 group-hover:scale-100 z-[110]">
                    <div class="bg-white border border-gray-100 shadow-xl rounded-xl overflow-hidden">
                        <?php if ( is_user_logged_in() ) : ?>
                            <?php if (class_exists('WooCommerce')) : ?>
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#fff6ef] hover:text-[#ff7a21] border-b border-gray-50">Tài khoản của tôi</a>
                                <a href="<?php echo wc_get_account_endpoint_url('orders'); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#fff6ef] hover:text-[#ff7a21] border-b border-gray-50">Đơn hàng</a>
                                <a href="<?php echo wc_get_account_endpoint_url('edit-address'); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#fff6ef] hover:text-[#ff7a21] border-b border-gray-50">Địa chỉ</a>
                            <?php else: ?>
                                <a href="<?php echo admin_url('profile.php'); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#fff6ef] hover:text-[#ff7a21] border-b border-gray-50">Tài khoản</a>
                            <?php endif; ?>
                            <a href="<?php echo wp_logout_url(home_url()); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#fff6ef] hover:text-[#ff7a21]">Đăng xuất</a>
                        <?php else : ?>
                            <a href="<?php echo class_exists('WooCommerce') ? get_permalink(get_option('woocommerce_myaccount_page_id')) : wp_login_url(); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#fff6ef] hover:text-[#ff7a21] border-b border-gray-50">Đăng nhập</a>
                            <a href="<?php echo class_exists('WooCommerce') ? get_permalink(get_option('woocommerce_myaccount_page_id')) : wp_registration_url(); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#fff6ef] hover:text-[#ff7a21]">Đăng ký</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Giỏ hàng -->
            <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <a href="<?php echo wc_get_cart_url(); ?>" class="text-gray-600 hover:text-[#ff7a21] transition relative flex items-center" title="Giỏ hàng">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full cart-count">
                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                </span>
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white border-t border-b border-gray-100 py-2 md:py-3 px-4 md:px-8 flex flex-wrap md:flex-nowrap justify-between items-center gap-y-2 relative z-[90]">
        <nav class="flex flex-wrap lg:flex-nowrap space-x-4 lg:space-x-6 text-sm font-bold text-gray-800 items-center relative z-[70]">
            <a href="<?php echo home_url('/'); ?>" class="py-2 transition-colors <?php echo is_front_page() ? 'text-[#ff7a21]' : 'hover:text-[#8b3dff]'; ?>">Trang Chủ</a>

            <!-- Menu Chó -->
            <div class="relative group">
                <a href="<?php echo pet_shop_get_cat_url('cho', 'Chó'); ?>" class="flex items-center hover:text-[#8b3dff] py-2 transition-colors cursor-pointer">
                    Chó
                    <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                
                <div class="absolute -left-[100px] top-full pt-2 w-[800px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 z-50 cursor-default">
                    <div class="bg-white border border-gray-100 shadow-2xl rounded-xl p-6">
                        <div class="grid grid-cols-3 gap-8">
                            <div>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Thức Ăn Cho Chó</h4>
                                <ul class="space-y-2 mb-6">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/hat-cho-cho/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Thức Ăn Hạt</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thuc-an-uot/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Thức Ăn Ướt</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thuc-an-ho-tro-dieu-tri-benh/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Thức Ăn Hỗ Trợ Điều Trị Bệnh</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thuc-an-huu-co/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Thức Ăn Hữu Cơ</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thuc-an-khong-ngu-coc/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Thức Ăn Không Ngũ Cốc</a></li>
                                </ul>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Chăm Sóc Vệ Sinh Cún</h4>
                                <ul class="space-y-2">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/ve-sinh-rang-mieng/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Vệ Sinh Răng Miệng</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/ve-sinh-tai-mat/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Vệ Sinh Tai - Mắt</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/sua-tam-phu-kien-tam/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Sữa Tắm & Phụ Kiện Tắm</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/xit-khu-mui/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Xịt Khử Mùi</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Bánh Thưởng</h4>
                                <ul class="space-y-2 mb-6">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/banh-thuong-mem/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Bánh Thưởng Mềm</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/xuong-gam-sach-rang/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Xương Gặm Sạch Răng</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/sup-thuong/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Súp Thưởng</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/banh-quy/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Bánh Quy</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thit-say-kho/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Thịt Sấy Khô</a></li>
                                </ul>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Phụ Kiện</h4>
                                <ul class="space-y-2">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/vong-co-day-dat/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Vòng Cổ & Dây Dắt</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/quan-ao-non-mu/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Quần Áo & Nón Mũ</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/dung-cu-an-uong/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Dụng Cụ Ăn Uống</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/nem-chuong-cho-cun/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Nệm - Chuồng Cho Cún</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/ta-lot-khay-ve-sinh/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Tả Lót & Khay Vệ Sinh</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Chăm Sóc Sức Khoẻ Cún</h4>
                                <ul class="space-y-2 mb-6">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/vitamin-cho-cho/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Vitamin Cho Chó</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/tri-ve-ran-xo-giun/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Trị Ve Rận & Xổ Giun</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thuc-pham-chuc-nang/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Thực Phẩm Chức Năng</a></li>
                                </ul>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Đồ Chơi</h4>
                                <ul class="space-y-2 mb-6">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/xuong-gam/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Xương Gặm</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/nhoi-bong/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Nhồi Bông</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/huan-luyen-tuong-tac/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Huấn Luyện & Tương Tác</a></li>
                                </ul>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Vận Chuyển</h4>
                                <ul class="space-y-2">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/balo-long-van-chuyen/'); ?>" class="text-gray-600 hover:text-[#ff7a21] text-[13px] transition-colors block">Balo Lồng Vận Chuyển</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Mèo -->
            <div class="relative group">
                <a href="<?php echo pet_shop_get_cat_url('meo', 'Mèo'); ?>" class="flex items-center hover:text-[#8b3dff] py-2 transition-colors cursor-pointer">
                    Mèo
                    <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                
                <div class="absolute -left-[160px] top-full pt-2 w-[850px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left scale-95 group-hover:scale-100 p-6 z-50 cursor-default">
                    <div class="bg-white border border-gray-100 shadow-2xl rounded-xl p-6">
                        <div class="grid grid-cols-4 gap-6">
                            <div>
                                <a href="<?php echo home_url('/danh-muc-san-pham/thuc-an-meo/'); ?>" class="block hover:text-[#ff7a21] transition-colors"><h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Thức Ăn Cho Mèo</h4></a>
                                <ul class="space-y-2 text-[13px]">
                                    <li><a href="<?php $cat = get_term_by('slug', 'hat-cho-meo', 'product_cat'); echo $cat ? esc_url(get_term_link($cat)) : '#'; ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Thức Ăn Hạt</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thuc-an-uot/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Thức Ăn Ướt</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thuc-an-dieu-tri-benh/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Thức Ăn Điều Trị Bệnh</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/banh-thuong-meo/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Bánh Thưởng Mèo</a></li>
                                </ul>
                            </div>
                            <div>
                                <a href="<?php echo home_url('/danh-muc-san-pham/phu-kien-do-choi-meo/'); ?>" class="block hover:text-[#ff7a21] transition-colors"><h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Phụ Kiện - Đồ Chơi</h4></a>
                                <ul class="space-y-2 text-[13px]">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/do-choi/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Đồ Chơi</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/thoi-trang-quan-ao/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Thời Trang - Quần Áo</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/vong-co-day-dat/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Vòng Cổ - Dây Dắt</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Vận Chuyển - Chuồng</h4>
                                <ul class="space-y-2 mb-6 text-[13px]">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/chuong-nha-nem/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Chuồng - Nhà Nệm</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/balo-long-van-chuyen/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Vận Chuyển</a></li>
                                </ul>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Chăm Sóc Sức Khỏe</h4>
                                <ul class="space-y-2 text-[13px]">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/sua-binh-bu-cho-meo/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Sữa & Bình Bú Cho Mèo</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/vitamin-thuc-pham-bo-sung/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Vitamin & Thực Phẩm Bổ Sung</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0f172a] mb-2 text-[14px]">Vệ Sinh</h4>
                                <ul class="space-y-2 text-[13px]">
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/cat-meo/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Cát Mèo</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/cham-soc-rang-mieng/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Chăm Sóc Răng Miệng</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/sua-tam/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Sữa Tắm</a></li>
                                    <li><a href="<?php echo home_url('/danh-muc-san-pham/xit-khu-mui/'); ?>" class="text-gray-600 hover:text-[#ff7a21] transition-colors block">Xịt Khử Mùi</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <?php
            function pet_get_blog_url() {
                $posts_page_id = get_option('page_for_posts');
                if ($posts_page_id) {
                    return get_permalink($posts_page_id);
                }
                
                // create or get category 'tin-tuc' to serve as backup link
                $cat = get_term_by('slug', 'tin-tuc', 'category');
                if (!$cat) {
                    wp_insert_term('Tin tức', 'category', ['slug' => 'tin-tuc']);
                    $cat = get_term_by('slug', 'tin-tuc', 'category');
                }
                if ($cat && !is_wp_error($cat)) {
                    return get_term_link($cat);
                }
                
                return home_url('/?post_type=post');
            }
            ?>
            <a href="<?php echo esc_url(pet_get_blog_url()); ?>" class="py-2 transition-colors <?php echo (is_home() || is_category() || is_tag() || is_singular('post')) ? 'text-[#ff7a21]' : 'hover:text-[#8b3dff]'; ?>">Blog Thú Cưng</a>
        </nav>
        <div class="font-bold text-sm text-gray-800">
            Hỗ trợ 24/7: <a href="tel:18001060" class="text-orange-500 hover:underline">1800 1060</a>
        </div>
    </div>
</header>
<div class="max-w-7xl mx-auto px-8 mt-4">
    <?php // if ( function_exists( 'woocommerce_output_all_notices' ) ) { woocommerce_output_all_notices(); } ?>
</div>
<main id="main-content">