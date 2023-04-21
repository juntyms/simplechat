<div class="form-group">
    <label for="name">Name</label>
    {{ Form::text('name',null,['class'=>'form-control']) }}
</div>
<div class="form-group">
    <label for="email">Email</label>
    {{ Form::text('email',null, ['class'=>'form-control']) }}
</div>
<div class="form-group">
    <label for="password">Password</label>
    {{ Form::password('password',['class'=>'form-control']) }}
</div>
<button class="btn btn-primary mt-3"> {{ $buttonText }}</button>