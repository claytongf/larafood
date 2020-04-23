@include('admin.includes.alerts')
<div class="form-group">
    <label for="identify">Nome:</label>
    <input type="text" name="identify" class="form-control" placeholder="Nome:" value="{{$table->identify ?? old('identify')}}">
</div>
<div class="form-group">
    <label for="email">Descrição:</label>
    <textarea name="description" class="form-control" rows="5" placeholder="Descrição:">{{$table->description ?? old('description')}}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>