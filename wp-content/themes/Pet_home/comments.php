<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-12 p-8 sm:p-10 bg-white rounded-[40px] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-2xl md:text-3xl font-extrabold text-[#8b3dff] mb-8 pb-4 border-b border-gray-100">
			<?php
			$pets_comment_count = get_comments_number();
			if ( '1' === $pets_comment_count ) {
				echo '1 Bình luận';
			} else {
				echo $pets_comment_count . ' Bình luận';
			}
			?>
		</h2>

		<ol class="comment-list p-0 m-0 space-y-8">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 56,
			) );
			?>
		</ol>

		<?php
		the_comments_pagination( array(
			'prev_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition">&laquo; Cũ hơn</span>',
			'next_text' => '<span class="text-[#8b3dff] font-bold px-4 py-2 border border-[#8b3dff] bg-white rounded-md hover:bg-[#8b3dff] hover:text-white transition">Mới hơn &raquo;</span>',
            'class'     => 'mt-8 flex justify-center gap-4'
		) );
		?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments text-gray-500 italic mt-6 text-center bg-gray-50 py-3 rounded-lg border border-gray-100">Bình luận đã bị đóng cho bài viết này.</p>
	<?php endif; ?>

	<?php
	comment_form( array(
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title text-2xl md:text-3xl font-extrabold text-gray-800 mt-10 mb-8 max-w-2xl">',
        'title_reply_after'  => '</h2>',
        'class_form'         => 'comment-form space-y-6 max-w-3xl',
        'comment_field'      => '<div class="comment-form-comment relative"><label for="comment" class="block text-sm font-bold text-gray-700 mb-2">Nội dung bình luận <span class="text-red-500">*</span></label><textarea id="comment" name="comment" cols="45" rows="5" maxlength="65525" required="required" class="w-full px-5 py-4 bg-gray-50 rounded-2xl border border-gray-200 focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-[#8b3dff] focus:bg-white transition-all resize-y" placeholder="Nhập bình luận của bạn vào đây..."></textarea></div>',
        'class_submit'       => 'submit bg-gradient-to-r from-[#8b3dff] to-[#ff7a21] hover:shadow-lg hover:-translate-y-1 text-white font-bold py-3 px-10 rounded-full transition-all cursor-pointer border-none',
        'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'fields'             => array(
            'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-6"><div class="comment-form-author relative"><label for="author" class="block text-sm font-bold text-gray-700 mb-2">Họ Tên <span class="text-red-500">*</span></label><input id="author" name="author" type="text" value="" size="30" maxlength="245" required="required" class="w-full px-5 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-[#8b3dff] focus:bg-white transition-all" placeholder="Ví dụ: Anh Dũng" /></div>',
            'email'  => '<div class="comment-form-email relative"><label for="email" class="block text-sm font-bold text-gray-700 mb-2">Địa chỉ Email <span class="text-red-500">*</span></label><input id="email" name="email" type="email" value="" size="30" maxlength="100" required="required" class="w-full px-5 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-[#8b3dff] focus:bg-white transition-all" placeholder="Email của bạn..." /></div></div>',
            'url'    => '<div class="comment-form-url mb-4 hidden"><label for="url" class="block text-sm font-bold text-gray-700 mb-2">Trang web</label><input id="url" name="url" type="url" value="" size="30" maxlength="200" class="w-full px-5 py-3 bg-gray-50 rounded-xl border border-gray-200 focus:outline-none focus:ring-4 focus:ring-purple-100 focus:border-[#8b3dff] focus:bg-white transition-all" /></div>',
        )
    ) );
	?>

</div>
