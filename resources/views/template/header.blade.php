<header class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a id="logo" class="pull-left" href="http://return"></a>
            <div class="nav-collapse collapse pull-right">
                <ul class="nav">
                    <li class="active"><a href="http://return">Home</a></li>
                    <li><a href="http://return/upload_file">Загрузка файлов</a></li>
                    <li><a href="/contact-us">Контакты</a></li>
                    <li><a href="/upload_news">Новости</a></li>
 <li>  <a href="{{ route('shopping-cart') }}">
         <i class="fa fa-shopping-cart" aria-hidden="true">В корзине <div class="badge" id = "ttq">{{$cart['totalQuantity']}}
             </div>товаров на сумму <span class="badge" id = "ttp">{{$cart['totalPrice']}}</span>рублей</i></a>
     <script>
         $(document).ready(function(){
             $('#button').on('click',function(data){
                 $('#ttq').text("Р");
             });
         });
     </script></li>




 <li class="login">
     <a data-toggle="modal" href="#loginForm"><i class="icon-lock"></i></a>
 </li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
</header>