@extends('layouts.app')

@section('title', 'Kontak Kami - Desa Gunung Sembung')

@section('content')

<header class="bg-gradient-to-br from-primary to-[#0F766E] text-white py-[60px] text-center mb-[40px] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

    <div class="container relative z-10 mx-auto px-5 max-w-6xl">
        <h1 class="m-0 mb-[10px] text-[30px] md:text-[36px] font-bold">Hubungi Pemerintah Desa</h1>
        <p class="m-0 text-[16px] md:text-[18px] opacity-90 max-w-[600px] mx-auto">
            Punya pertanyaan, keluhan, atau butuh layanan administrasi? Jangan ragu untuk menghubungi kami melalui form atau kontak di bawah ini.
        </p>
    </div>
</header>

<main class="container mx-auto px-5 max-w-6xl mb-[60px]">

    <div class="flex flex-col lg:flex-row gap-[40px]">

        <!-- INFORMASI KONTAK -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-[12px] p-[30px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0] h-full">

                <h2 class="text-primary text-[22px] mt-0 pb-[15px] border-b-[2px] border-[#F1F5F9] font-bold mb-[25px]">
                    Informasi Kontak
                </h2>

                <div class="flex flex-col gap-[20px]">

                    <div class="flex items-start gap-[15px]">
                        <div class="w-[45px] h-[45px] bg-[#CCFBF1] text-primary rounded-full flex items-center justify-center text-[20px] shrink-0">
                            📍
                        </div>
                        <div>
                            <h4 class="m-0 text-[16px] font-bold mb-[5px]">Alamat Kantor</h4>
                            <p class="m-0 text-[14px] text-gray-600 leading-relaxed">
                                Jl. Raya Gunung Sembung No. 1, Kecamatan Pagaden, Kab. Subang, Jawa Barat 41252
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-[15px]">
                        <div class="w-[45px] h-[45px] bg-[#CCFBF1] text-primary rounded-full flex items-center justify-center text-[20px] shrink-0">
                            📞
                        </div>
                        <div>
                            <h4 class="m-0 text-[16px] font-bold mb-[5px]">Telepon / WhatsApp</h4>
                            <p class="m-0 text-[14px] text-gray-600 leading-relaxed">
                                +62 812-3456-7890 <br>
                                <span class="text-[12px] italic">(Hanya melayani di jam kerja)</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-[15px]">
                        <div class="w-[45px] h-[45px] bg-[#CCFBF1] text-primary rounded-full flex items-center justify-center text-[20px] shrink-0">
                            ✉️
                        </div>
                        <div>
                            <h4 class="m-0 text-[16px] font-bold mb-[5px]">Email</h4>
                            <p class="m-0 text-[14px] text-gray-600 leading-relaxed">
                                pemdes@gunungsembung.desa.id
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-[15px]">
                        <div class="w-[45px] h-[45px] bg-[#CCFBF1] text-primary rounded-full flex items-center justify-center text-[20px] shrink-0">
                            🕒
                        </div>
                        <div>
                            <h4 class="m-0 text-[16px] font-bold mb-[5px]">Jam Operasional</h4>
                            <p class="m-0 text-[14px] text-gray-600 leading-relaxed">
                                <strong>Senin - Kamis:</strong> 08:00 - 15:00 WIB<br>
                                <strong>Jumat:</strong> 08:00 - 11:30 WIB<br>
                                <strong>Sabtu - Minggu:</strong> Libur
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- GOOGLE MAPS -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-[12px] p-[20px] shadow-[0_1px_3px_rgba(0,0,0,0.05)] border border-[#E2E8F0] h-full">

                <h2 class="text-primary text-[22px] mt-0 mb-[20px] font-bold">
                    Peta Lokasi Desa
                </h2>

                <div class="w-full h-[500px] rounded-[8px] overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d42366.33905210329!2d107.77369830580076!3d-6.508769532938292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6939623150ac41%3A0xd47d069d577716de!2sGunungsembung%2C%20Kec.%20Pagaden%2C%20Kabupaten%20Subang%2C%20Jawa%20Barat!5e1!3m2!1sid!2sid!4v1776527673605!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
        </div>

    </div>

</main>

@endsection