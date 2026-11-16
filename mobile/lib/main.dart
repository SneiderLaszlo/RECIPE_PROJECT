import 'package:flutter/material.dart';
import 'package:mobile_scanner/mobile_scanner.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() => runApp(const KitchenHelperApp());

class KitchenHelperApp extends StatelessWidget {
  const KitchenHelperApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Kitchen Helper',
      theme: ThemeData(colorSchemeSeed: Colors.green),
      home: const SzkennerKepernyo(),
    );
  }
}

class SzkennerKepernyo extends StatefulWidget {
  const SzkennerKepernyo({super.key});

  @override
  State<SzkennerKepernyo> createState() => _SzkennerKepernyoState();
}

class _SzkennerKepernyoState extends State<SzkennerKepernyo> {
  final MobileScannerController _controller = MobileScannerController();
  bool _feldolgozas = false;
  String _uzenet = 'Olvass be egy vonalkódot';

  Future<void> _kodKezeles(BarcodeCapture capture) async {
    if (_feldolgozas) return;
    final kod = capture.barcodes.first.rawValue;
    if (kod == null) return;

    setState(() {
      _feldolgozas = true;
      _uzenet = 'Keresés: $kod';
    });

    try {
      final url = Uri.parse(
          'https://world.openfoodfacts.org/api/v2/product/$kod.json');
      final valasz = await http.get(url);
      final adat = jsonDecode(valasz.body);

      if (adat['status'] == 1) {
        final nev = adat['product']['product_name'] ?? 'Nincs név';
        setState(() => _uzenet = 'Találat: $nev');
      } else {
        setState(() => _uzenet = 'Nincs találat erre: $kod');
      }
    } catch (e) {
      setState(() => _uzenet = 'Hiba: $e');
    }

    await Future.delayed(const Duration(seconds: 3));
    setState(() => _feldolgozas = false);
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Virtuális hűtő')),
      body: Column(
        children: [
          Expanded(
            child: MobileScanner(
              controller: _controller,
              onDetect: _kodKezeles,
            ),
          ),
          Padding(
            padding: const EdgeInsets.all(16),
            child: Text(_uzenet, style: const TextStyle(fontSize: 18)),
          ),
        ],
      ),
    );
  }
}