<div class="row">
    <div class="col-xs-4 col-xs-offset-4">
        <h1 class="page-header"></h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="text-center"><strong>USER LOGIN</strong></h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="user/login" method="post">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">User Name: </label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password: </label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-10">
                            <button type="submit" class="btn btn-primary"><strong>Login</strong></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>