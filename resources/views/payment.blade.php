@extends('layouts.master')
@section('title','Payment')
@section('content')
    <div class="container">   
        <div class="bg-content">
            <form action="{{route('pay')}}" method="POST">
                @csrf
            <h2>Ödəniş</h2>
            <div class="row">
                <div class="col-md-5">
                    <h3>Ödəniş məlumatı</h3>
                    <div class="form-group">
                        <label for="kartno">Kredit kartı nömrəsi</label>
                        <input type="text" class="form-control kredikarti" id="cardnumber" name="cardnumber" style="font-size:20px;" required>
                    </div>
                    <div class="form-group">
                        <label for="cardexpiredatemonth">İstifadə müddəti</label>
                        <div class="row">
                            <div class="col-md-6">
                                Ay
                                <select name="cardexpiredatemonth" id="cardexpiredatemonth" class="form-control" required>
                                    <option>1</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                il
                                <select id="cardexpiredateyear" name="cardexpiredateyear" class="form-control" required>
                                    <option>2017</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardcvv2">CVV (Təhlükəsizlik Nömrəsi)</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control kredikarti_cvv" name="cardcvv2" id="cardcvv2" required>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" checked> ilkin məlumat formasını oxudum və qəbul edirəm.</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" checked> Məsafədən satış müqaviləsini oxudum və qəbul edirəm.</label>
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-success btn-lg">Ödəniş et</button>
                </div>
                <div class="col-md-7">
                    <h4>Ödəniləcək məbləğ</h4>
                    <span class="price">{{Cart::total()}} <small>manat</small></span>

                    <h4>Əlaqə və faktura məlumatları</h4>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="name">Ad Soyad</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{Auth::user()->name}}" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="name">Ünvan</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$user_detail->address}}" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" class="form-control phone" name="phone" id="phone" value="{{$user_detail->phone}}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
@endsection