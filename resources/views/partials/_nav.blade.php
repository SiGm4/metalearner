<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                MetaLearner
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
            <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="/about">About</a></li>
            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
            <li class="{{ Request::is('posts') ? 'active' : '' }}"><a href="/posts">Posts</a></li>
            <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="/blog">Blog</a></li>
        </ul>

        @auth
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->email }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/posts">Posts</a></li>
                    <li><a href="/categories">Categories</a></li>
                    <li><a href="/tags">Tags</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <form method="POST" action="/logout"> 
                            <input type="submit" value="Logout" class="btn btn-link" id="logoutBtn"> 
                            {{ csrf_field() }}  
                        </form> 
                    </li>
                </ul>
            </li>
        </ul>
        @endauth

    </div>
</nav>