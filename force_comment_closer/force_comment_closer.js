(function($) {
	$("div.tablenav.top div").eq(1).after(
		$("<div>")
		.addClass("force_comment_closer_block alignleft actions")
		.append($("<form>")
			.addClass("postform force_comment_closer_form")
			.attr({name:"force_comment_closer_form",method:"POST"})
			.append($("<select>")
				.append($('<option>').val("open").text("全投稿でコメントを許可"))
				.append($('<option>').val("close").text("全投稿でコメントを不許可"))
				.attr("name","force_comment_closer")
			)
			.append(
				$("<button>")
				.addClass("button")
				.attr("type","button")
				.text("全投稿一括コメント許可設定変更")
				.on("click",function(){
					var mode = "許可";
					if($("select[name='force_comment_closer_selecter']").val() == "close"){
						mode = "不許可";
					}
					if(window.confirm("全ての投稿のコメントを" + mode + "に設定します。\nよろしいですか？")){
						$("form.force_comment_closer_form").submit();
					} else {
						return true;
					}
				})
			)
		)
	);
})(jQuery);
