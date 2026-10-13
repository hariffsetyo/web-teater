<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Tiket Pementasan — {{ $ticket->kode_tiket }}</title>
    <style>
        @page {
            margin: 20px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1a1a1a;
            background-color: #faf6ee;
            margin: 0;
            padding: 20px;
        }
        .ticket-wrapper {
            border: 3px double #b08d23;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            position: relative;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #5b0f1a;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #5b0f1a;
            font-size: 24px;
            margin: 0 0 5px 0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .header p {
            color: #b08d23;
            font-size: 11px;
            margin: 0;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .content-table td {
            vertical-align: top;
            padding: 6px;
        }
        .label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .value {
            font-size: 14px;
            font-weight: bold;
            color: #111;
        }
        .code-box {
            text-align: center;
            background: #fdf2f4;
            border: 1px dashed #5b0f1a;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .code-box .code {
            font-size: 18px;
            font-weight: bold;
            color: #5b0f1a;
            letter-spacing: 2px;
            font-family: monospace;
        }
        .qr-section {
            text-align: center;
            padding: 10px;
        }
        .footer-rules {
            font-size: 9px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 12px;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="ticket-wrapper">
        <div class="header">
            <p>✦ EKSTRAKURIKULER TEATER SEKOLAH SMA NEGERI 1 ✦</p>
            <h1>TEATER SIKLUS</h1>
            <p>E-TIKET RESMI PEMENTASAN DRAMA • ADMIT ONE</p>
        </div>

        <div class="code-box">
            <span class="label">KODE RESERVASI TIKET:</span><br/>
            <span class="code">{{ $ticket->kode_tiket }}</span>
        </div>

        <table class="content-table">
            <tr>
                <td style="width: 65%;">
                    <table style="width: 100%;">
                        <tr>
                            <td colspan="2">
                                <span class="label">Judul Lakon Pementasan:</span><br/>
                                <span class="value" style="font-size: 18px; color: #5b0f1a;">
                                    {{ $ticket->performance->judul_pementasan }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%; padding-top: 10px;">
                                <span class="label">Tanggal Pementasan:</span><br/>
                                <span class="value">
                                    {{ $ticket->performance->event->tanggal_mulai ? $ticket->performance->event->tanggal_mulai->translatedFormat('d F Y') : '-' }}
                                </span>
                            </td>
                            <td style="width: 50%; padding-top: 10px;">
                                <span class="label">Pukul / Waktu:</span><br/>
                                <span class="value">
                                    {{ $ticket->performance->event->tanggal_mulai ? $ticket->performance->event->tanggal_mulai->format('H:i') : '15:30' }} WIB
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 10px;">
                                <span class="label">Tempat / Gedung Pertunjukan:</span><br/>
                                <span class="value">
                                    {{ $ticket->performance->event->lokasi ?? 'Aula Utama Gedung Seni Budaya' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;">
                                <span class="label">Nama Pemesan:</span><br/>
                                <span class="value">{{ $ticket->nama }}</span>
                            </td>
                            <td style="padding-top: 10px;">
                                <span class="label">Jumlah Kursi:</span><br/>
                                <span class="value" style="color: #b08d23;">{{ $ticket->jumlah_tiket }} Orang</span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 35%; text-align: center; border-left: 2px dashed #b08d23;">
                    <div class="qr-section">
                        {!! $qrCodeSvg !!}
                        <br/>
                        <span class="label" style="font-size: 8px;">Pindai di Meja Registrasi Masuk</span>
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer-rules">
            <strong>Tata Tertib & Petunjuk Penonton:</strong><br/>
            1. Pintu panggung dibuka 30 menit sebelum pementasan dan ditutup tepat saat lakon babak pertama dimulai.<br/>
            2. Harap menunjukkan lembar tiket ini (cetak atau dari ponsel) kepada petugas penerima tamu.<br/>
            3. Dilarang mengaktifkan nada dering ponsel atau menggunakan lampu kilat (flash) kamera selama pementasan berlangsung.<br/>
            4. Tiket ini merupakan bukti reservasi yang sah dan terdaftar resmi di sistem sanggar Teater Siklus.
        </div>
    </div>
</body>
</html>