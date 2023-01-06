<!DOCTYPE html>
<html lang="ch">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link type="text/css" rel="styleSheet" href="css/dict.css" />
		<link rel="stylesheet" href="css/manage.css">
		<script src="js/jquery.js"></script>
		<script>
        var winHeight = $(window).height();
        var winWidth = $(window).width();
        var angle=screen.orientation.angle
        $(window).resize(function() {
            if(navigator.userAgent.match(/mobile/i)){
                if (angle !=screen.orientation.angle)
                {
                    location.reload()
                }
                // 解决翻转屏幕无法改变高度
                $("body").css("height",winHeight+"px");
                $("body").css("width",winWidth+"px");
            }
        });
            window.addEventListener('onorientationchange', ()=>{
                alert(screen.orientation);
            }, true);
    // 解决手机版输入时的页面挤压
    </script>
		<!-- <link rel="stylesheet" href="css/page_select.css"> -->
		<title>dict</title>
	</head>
	<form name='date' action='books.php' method='post'>
		<input type='hidden' name='data_validity_period' id="data_validity_period" value='' />
	</form>
	<div id="main">
		<?php
            $file=fopen('menubar.page','rb');
            echo fread($file,filesize('search.page'));
            fclose($file);
        ?>
		<div id="right">
			<div class="container">
				<div class="manage">
					<table class="el-table__body">
						<tbody>


                            <?php
                                include("manage_info.php");
                                for($i=0;$i<$size;$i++)
                                {                  
                                    $words_list=array_keys($manage_data[$i]);
                                    $word_list=$manage_data[$i][$words_list[0]];
                                    // print_r($manage_data);
                                    $word_size=count($word_list);
                                    print(" <tr class=\"el-table__row\"> <td class=\"\" width=\"150px\">     <div class=\"cell\">         <span>".$words_list[0]."</span>     </div> </td> <td class=\"manage_means_td\">     <div class=\"manage_means_div\">");
                                    for($p=0;$p<$word_size;$p++)
                                    {
                                        $posd_list=array_keys($word_list);
                                        echo "<p class=\"means_p\"><span>".$posd_list[$p]."</span><input class=\"chinese_input\" value=\"".$word_list[$posd_list[$p]]."\" readonly=\"\"></p>";
                                    }
                                    echo "</div></td><td class=\"\" width=\"200px\"><div class=\"cell manage_button_div\"><button type=\"button\" class=\"el-button el-button--primary el-button--mini\"><span>编辑</span></button><button type=\"button\"class=\"el-button el-button--danger el-button--mini\"><span>删除</span></button></div></td></tr>";
                                }
                                // print_r(count($word_ids));
                            ?>





						</tbody>
					</table>


					<div data-v-6af373ef="" class="el-pagination is-background">
						<span class="el-pagination__total">共 <?php echo $word_num?> 条</span>



						<span class="el-pagination__sizes">
							<div class="el-select el-select--mini">
								<!---->


								<select name="page_num" class="page_num">
									<option value="10">10</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>


								<div class="el-select-dropdown el-popper" style="display: none; min-width: 110px;">
									<div class="el-scrollbar" style="">
										<div class="el-select-dropdown__wrap el-scrollbar__wrap" style="margin-bottom: -17px; margin-right: -17px;">
											<ul class="el-scrollbar__view el-select-dropdown__list">
												<!---->
												<li class="el-select-dropdown__item">
													<span>10条/页</span>
												</li>
												<li class="el-select-dropdown__item selected">
													<span>20条/页</span>
												</li>
												<li class="el-select-dropdown__item">
													<span>30条/页</span>
												</li>
												<li class="el-select-dropdown__item">
													<span>50条/页</span>
												</li>
											</ul>
										</div>
										<div class="el-scrollbar__bar is-horizontal">
											<div class="el-scrollbar__thumb" style="transform: translateX(0%);">
											</div>
										</div>
										<div class="el-scrollbar__bar is-vertical">
											<div class="el-scrollbar__thumb" style="transform: translateY(0%);">
											</div>
										</div>
									</div>
									<!---->
								</div>
							</div>
						</span>


						</span>
						<button type="button"  class="btn-prev">
							<span class="page_control">
                                上一页
                            </span>
                            </button>
                            <ul class="el-pager">
                            <li class="number" id="1">#</li>
                            <!---->
                            <li class="number" id="2">#</li>
                            <li class="number" id="3">#</li>
                            <li class="number" id="4">#</li>
                            <!---->
                            <li class="number" id="5">#</li>
                            </ul>
                            <button type="button" class="btn-next">
                                <span class="page_control">下一页</span>
                            </button>
                            <button type="button" id="jump_to_page">
                                <span>前往</span>
                            </button>
                            <span class="el-pagination__jump">
                                <input type="number" autocomplete="off" class="el-input__inner">页
                            </span>

					</div>
				</div>
			</div>
			</body>

    <script>

        if(navigator.userAgent.match(/mobile/i)){
            document.querySelector("#jump_to_page").style.display="none"
            document.querySelector("#right > div > div > div > span.el-pagination__jump").style.display="none"
            document.querySelector("#right > div > div > div > span.el-pagination__total").style.display="none"
            document.querySelector("#right > div > div > div > span.el-pagination__sizes").style.display="none"
        }


        getQueryString=function(name){
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
            var r = window.location.search.substr(1).match(reg);
            if (r != null) return decodeURI(r[2]); return null;
            
        }

        var max_page_num=Math.ceil(<?php echo $word_num?>/Number(getQueryString("limit")));
        document.querySelector("#right > div > div > div > span.el-pagination__jump > input").value=getQueryString("page_num")

        // ###############
        // 以下是页数选择栏的显示逻辑        
        if (Number(getQueryString("page_num")) ==1)
        {
            document.querySelector("#\\31 ").innerText=Number(getQueryString("page_num"))
            document.querySelector("#\\31 ").className="active number"

            document.querySelector("#\\32 ").innerText=Number(getQueryString("page_num"))+1
            document.querySelector("#\\32 ").className="number"

            document.querySelector("#\\33 ").innerText=Number(getQueryString("page_num"))+2
            document.querySelector("#\\33 ").className="number"

            document.querySelector("#\\34 ").innerText=Number(getQueryString("page_num"))+3
            document.querySelector("#\\34 ").className="number"

            document.querySelector("#\\35 ").innerText=Number(getQueryString("page_num"))+4
            document.querySelector("#\\35 ").className="number"
        }
        else if ((Number(getQueryString("page_num"))<=3) ){
            for (i=Number(getQueryString("page_num"))-1;i>0;i--)
            {
                document.querySelector("#\\3"+(Number(getQueryString("page_num"))-i)).innerText=Number(getQueryString("page_num"))-i
                document.querySelector("#\\3"+(Number(getQueryString("page_num")))).className="number"
            }
            for (i=1;i<6-Number(getQueryString("page_num"));i++)
            {
                document.querySelector("#\\3"+(Number(getQueryString("page_num"))+i)).innerText=Number(getQueryString("page_num"))+i
                document.querySelector("#\\3"+(Number(getQueryString("page_num")))).className="number"
            }
            document.querySelector("#\\3"+(Number(getQueryString("page_num")))).innerText=Number(getQueryString("page_num"))
            document.querySelector("#\\3"+(Number(getQueryString("page_num")))).className="active number"
            
        }
        else if ((Number(getQueryString("page_num"))+3>max_page_num)){
            for (i=1;i<5-(max_page_num-Number(getQueryString("page_num")));i++)
            {
                console.log(i)
                document.querySelector("#\\3"+i).innerText=Number(getQueryString("page_num"))-(5-(max_page_num-Number(getQueryString("page_num")))-i)
                document.querySelector("#\\3"+i).className="number"
            }
            for (i=1;i<=(max_page_num-Number(getQueryString("page_num")));i++)
            {
                document.querySelector("#\\3"+(5-(max_page_num-Number(getQueryString("page_num")))+i)).innerText=Number(getQueryString("page_num"))+i
                document.querySelector("#\\3"+(5-(max_page_num-Number(getQueryString("page_num")))+i)).className="number"
            }


            document.querySelector("#\\3"+(5-(max_page_num-Number(getQueryString("page_num"))))).innerText=Number(getQueryString("page_num"))
            document.querySelector("#\\3"+(5-(max_page_num-Number(getQueryString("page_num"))))).className="active number"
            
        }
        else{
            document.querySelector("#\\31 ").innerText=Number(getQueryString("page_num"))-2
            document.querySelector("#\\31 ").className="number"

            document.querySelector("#\\32 ").innerText=Number(getQueryString("page_num"))-1
            document.querySelector("#\\32 ").className="number"

            document.querySelector("#\\33 ").innerText=Number(getQueryString("page_num"))
            document.querySelector("#\\33 ").className="active number"

            document.querySelector("#\\34 ").innerText=Number(getQueryString("page_num"))+1
            document.querySelector("#\\34 ").className="number"
            
            document.querySelector("#\\35 ").innerText=Number(getQueryString("page_num"))+2
            document.querySelector("#\\35 ").className="number"
        }
        // ###############

        $('.number').click(function(event){
            event= event|| window.event; // 事件
            var target = event.target || event.srcElement; // 获得事件源
            var id= target.getAttribute('id'); // 获得事件源的相关属性
            book_name=getQueryString("book_name")
            limit=getQueryString("limit")
            window.location.href="/manage.php?book_name="+book_name+"&limit="+limit+"&page_num="+target.innerText
		}
		);
        $('.page_num').change(function(){
            book_name=getQueryString("book_name")
            page_num=getQueryString("page_num")
            limit=document.getElementsByClassName("page_num")[0].value
            window.location.href="/manage.php?book_name="+book_name+"&limit="+limit+"&page_num="+page_num
		}
		);
        $('.btn-prev').click(function(){
            book_name=getQueryString("book_name")
            page_num=Number(getQueryString("page_num"))
            if (page_num!=1)
            {
                page_num=Number(getQueryString("page_num"))-1
            }
            limit=getQueryString("limit")
            window.location.href="/manage.php?book_name="+book_name+"&limit="+limit+"&page_num="+page_num
		}
		);
        $('.btn-next').click(function(){
            book_name=getQueryString("book_name")
            page_num=Number(getQueryString("page_num"))
            if (Number(getQueryString("page_num"))!=max_page_num)
            {
                page_num=Number(getQueryString("page_num"))+1
            }
            limit=getQueryString("limit")
            window.location.href="/manage.php?book_name="+book_name+"&limit="+limit+"&page_num="+page_num
		}
		);
        $('#jump_to_page').click(function(){
            book_name=getQueryString("book_name")
            limit=getQueryString("limit")
            page_num=document.querySelector("#right > div > div > div > span.el-pagination__jump > input").value
            if (page_num!="")
            {
                window.location.href="/manage.php?book_name="+book_name+"&limit="+limit+"&page_num="+page_num
            }
		}
		);
        
    </script>
</html>