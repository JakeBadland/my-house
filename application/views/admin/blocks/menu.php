<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Building.od.ua</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Меню <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li <? echo ($this->action == 'slider'? 'class="active"': '') ?> ><a href="/dna/slider">Слайдер</a></li>
                    <li <? echo ($this->action == 'main'? 'class="active"': '') ?> ><a href="/dna/main">Главная</a></li>
                    <li <? echo ($this->action == 'gallery'? 'class="active"': '') ?> ><a href="/dna/gallery">Галерея</a></li>
                    <li <? echo ($this->action == 'contacts'? 'class="active"': '') ?> ><a href="/dna/contacts">Контакты</a></li>
                    <li <? echo ($this->action == 'calls'? 'class="active"': '') ?> ><a href="/dna/calls">Звонки</a></li>
                    <li <? echo ($this->action == 'messages'? 'class="active"': '') ?> ><a href="/dna/messages">Сообщения</a></li>
                    <li <? echo ($this->action == 'templates'? 'class="active"': '') ?> ><a href="/dna/templates">Шаблоны</a></li>
                </ul>
            </li>
            <li>
                <a href="/auth/logout">Выход</a>
            </li>
        </ul>
    </div>
</nav>