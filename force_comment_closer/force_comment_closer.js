(function($) {

console.log($("div.tablenav.top div").eq(2));
	$("div.tablenav.top div").eq(1).after(
		$("<div>")
		.addClass("force_comment_closer_block alignleft actions")
		.append($("<form>")
			.attr({name:"force_comment_closer",method:"POST"})
			.append(
				$("<button>")
				.addClass("button")
				.text("全投稿一括コメント不許可化")
				.on("click",function(){
					submit();
				})
			)
			.append($("<input>")
				.attr({type:"hidden",name:"force_comment_closer",value:"true"})
				
			)
		)
	);
		
})(jQuery);
