@include('admin.includes.alerts')
<div class="form-group">
    <label for="name">* Título do Produto:</label>
    <input type="text" name="name" class="form-control" placeholder="Título do Produto:" value="{{$product->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="price">* Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{$product->price ?? old('price')}}">
</div>
<div class="form-group">
    <label for="image">Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label for="description">* Descrição:</label>
    <textarea name="description" class="form-control" rows="5" placeholder="Descrição:">{{$product->description ?? old('description')}}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>