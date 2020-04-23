@include('admin.includes.alerts')
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{$category->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="email">Descrição:</label>
    <textarea name="description" class="form-control" rows="5" placeholder="Descrição:">{{$category->description ?? old('description')}}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>