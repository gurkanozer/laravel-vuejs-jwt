<div class="card">
    <form class="card-body">
        <h4 class="card-title">Soru görüş ve önerileriniz için bize ulaşabilirsiniz.</h4>
        <hr/>
        @csrf
        <div class="form-group">
            <label for="full_name">Ad Soyad:</label>
            <input type="text" class="form-control" id="full_name" name="full_name">
        </div>
        <div class="form-group">
            <label for="subject">Konu:</label>
            <input type="text" class="form-control" id="subject" name="subject">
        </div>
        <div class="form-group">
            <label for="email">Eposta:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="content">Mesajınız:</label>
            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
        </div>
    </form>
</div>
