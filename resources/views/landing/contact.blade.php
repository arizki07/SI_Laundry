@extends('layouts.landing')

@section('styles')
    {{-- Styles --}}
@endsection

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Hubungi Kami</p>
                    <h1 class="display-5 mb-5" style="font-size: 30px;">Ada Pertanyaan? Hubungi Kami Sekarang</h1>
                    <p class="mb-4">Kami siap membantu Anda dengan layanan laundry terbaik. Jangan ragu untuk menghubungi
                        kami kapan saja untuk informasi lebih lanjut atau kebutuhan khusus Anda.</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                                    <label for="name">Nama Anda</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email Anda">
                                    <label for="email">Email Anda</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subjek">
                                    <label for="subject">Subjek</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Tulis pesan Anda di sini" id="message" style="height: 100px"></textarea>
                                    <label for="message">Pesan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px;">
                    <div class="position-relative rounded overflow-hidden h-100 shadow-lg">
                        <iframe class="position-relative w-100 h-100 rounded"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.1043761584965!2d109.25800496389006!3d-7.400152467374043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70e56c9b94dcbf%3A0xd462cbd2ef004e98!2sTelkom%20University%20Purwokerto!5e0!3m2!1sen!2sid!4v1603794290143!5m2!1sen!2sid&zoom=15"
                            frameborder="0" style="min-height: 450px; border: 0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('scripts')
    {{-- Scripts --}}
@endsection
