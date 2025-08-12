<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk {{ $transaction->transaction_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            background: white;
            color: #000;
            font-size: 12px;
            line-height: 1.3;
        }

        .receipt {
            width: 300px;
            margin: 0 auto;
            padding: 15px;
            background: white;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .store-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .store-info {
            font-size: 11px;
            line-height: 1.4;
        }

        .transaction-info {
            margin: 15px 0;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
            font-size: 11px;
        }

        .info-label {
            font-weight: bold;
        }

        .items-section {
            margin: 15px 0;
        }

        .item {
            margin: 8px 0;
            border-bottom: 1px dotted #ccc;
            padding-bottom: 5px;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
        }

        .summary-section {
            margin-top: 15px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
            padding: 1px 0;
        }

        .summary-row.total {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 5px 0;
            font-weight: bold;
            font-size: 14px;
            margin: 8px 0;
        }

        .summary-row.payment {
            margin-top: 8px;
            padding-top: 5px;
            border-top: 1px dotted #888;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            border-top: 2px solid #000;
            padding-top: 10px;
        }

        .thank-you {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .footer-info {
            font-size: 10px;
            color: #666;
        }

        .amount {
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }

        /* Print Styles */
        @media print {
            body {
                font-size: 10px;
            }
            
            .receipt {
                width: auto;
                margin: 0;
                padding: 10px;
            }

            .store-name {
                font-size: 16px;
            }

            .summary-row.total {
                font-size: 12px;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div class="store-name">FLAVORISE</div>
            <div class="store-info">
                Jl. Example No. 123<br>
                Telp: 08xx-xxxx-xxxx<br>
                NPWP: xx.xxx.xxx.x-xxx.xxx
            </div>
        </div>

        <!-- Transaction Info -->
        <div class="transaction-info">
            <div class="info-row">
                <span class="info-label">No. Transaksi:</span>
                <span>{{ $transaction->transaction_code }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal:</span>
                <span>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kasir:</span>
                <span>{{ $transaction->user?->name ?? 'System' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Pembayaran:</span>
                <span>{{ strtoupper($transaction->payment_method) }}</span>
            </div>
        </div>

        <!-- Items -->
        <div class="items-section">
            @foreach($transaction->items as $item)
                <div class="item">
                    <div class="item-name">{{ $item->menu->name }}</div>
                    <div class="item-details">
                        <span>{{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}</span>
                        <span class="amount">Rp {{ number_format($item->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span class="amount">Rp {{ number_format($transaction->subtotal ?? 0, 0, ',', '.') }}</span>
            </div>
            
            @if($transaction->discount > 0)
            <div class="summary-row">
                <span>Diskon:</span>
                <span class="amount">- Rp {{ number_format($transaction->discount, 0, ',', '.') }}</span>
            </div>
            @endif

            @if($transaction->tax > 0)
            <div class="summary-row">
                <span>Pajak ({{ round(($transaction->tax / ($transaction->subtotal - $transaction->discount)) * 100) }}%):</span>
                <span class="amount">Rp {{ number_format($transaction->tax, 0, ',', '.') }}</span>
            </div>
            @endif

            <div class="summary-row total">
                <span>TOTAL:</span>
                <span class="amount">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>

            @if($transaction->payment_method === 'cash')
            <div class="summary-row payment">
                <span>Tunai:</span>
                <span class="amount">Rp {{ number_format($transaction->paid_amount ?? $transaction->total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
                <span>Kembali:</span>
                <span class="amount">Rp {{ number_format($transaction->change_amount ?? 0, 0, ',', '.') }}</span>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="thank-you">TERIMA KASIH</div>
            <div class="thank-you">ATAS KUNJUNGAN ANDA</div>
            <div style="margin: 10px 0;">================================</div>
            <div class="footer-info">
                Barang yang sudah dibeli<br>
                tidak dapat dikembalikan<br>
                <br>
                Kritik & saran hubungi kami<br>
                di nomor telepon di atas
            </div>
        </div>
    </div>
</body>
</html>