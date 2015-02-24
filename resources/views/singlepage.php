<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>Angular JS</title>
    <link rel="stylesheet" href="/css/misc.css">
    <link rel="stylesheet" href="/css/app2.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/nav.css">
    <script src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/underscore-min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/angular-route.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/misc.js"></script>
</head>
<body>

<div class="container">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">MesaPBX</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#/home">Home</a></li>
                    <li><a href="#/users">Users</a></li>
                    <li><a href="#/extensions">Extensions</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#/home" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Lester Mesa <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="#/login">Logout</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control pull-right" style="width: 300px; margin-right: 35px, border: 1px solid black; background-color: #e5e5e5;" placeholder="Search">
						<span class="input-group-btn">
							<button type="reset" class="btn btn-default">
								<span class="glyphicon glyphicon-remove">
									<span class="sr-only">Close</span>
								</span>
                            </button>
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-search">
									<span class="sr-only">Search</span>
								</span>
                            </button>
						</span>
                    </div>
                </form>

            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <div id="flash" class="alert alert-danger" ng-show="flash">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ flash }}
    </div>


<div id="view" ng-view></div>

</div>
</body>
</html>