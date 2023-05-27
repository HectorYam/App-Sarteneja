import 'dart:developer';

import 'package:flutter/material.dart';
import 'package:sartenejas_app/model/categorias_model.dart';
import 'package:sartenejas_app/modules/main/providers/categorias_provider.dart';
import 'grutas.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'dart:async';
import 'package:dio/dio.dart';

void main() => runApp(const MyApp());

class comentario {
  final int id;
  final String Nombre;
  final String Comentarios;

  comentario(this.id, this.Nombre, this.Comentarios);
}

final List<String> imgList = [
  'http://www.sartenejas2.byethost9.com/img/inicio/2.jpg',
  'https://images.unsplash.com/photo-1522205408450-add114ad53fe?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=368f45b0888aeb0b7b08e3a1084d3ede&auto=format&fit=crop&w=1950&q=80',
  'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=94a1e718d89ca60a6337a6008341ca50&auto=format&fit=crop&w=1950&q=80',
  'https://images.unsplash.com/photo-1523205771623-e0faa4d2813d?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=89719a0d55dd05e2deae4120227e6efc&auto=format&fit=crop&w=1953&q=80',
  'https://images.unsplash.com/photo-1508704019882-f9cf40e475b4?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=8c6e5e3aba713b17aa1fe71ab4f0ae5b&auto=format&fit=crop&w=1352&q=80',
  'https://images.unsplash.com/photo-1519985176271-adb1088fa94c?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=a0c8d632e977f94e5d312d9893258f59&auto=format&fit=crop&w=1355&q=80'
];

final List<Widget> imageSliders = imgList
    .map((item) => Container(
          margin: const EdgeInsets.all(5.0),
          child: ClipRRect(
              borderRadius: const BorderRadius.all(Radius.circular(5.0)),
              child: Stack(
                children: <Widget>[
                  Image.network(item, fit: BoxFit.cover, width: 1000.0),
                  Positioned(
                    bottom: 0.0,
                    left: 0.0,
                    right: 0.0,
                    child: Container(
                      decoration: const BoxDecoration(
                        gradient: LinearGradient(
                          colors: [
                            Color.fromARGB(200, 0, 0, 0),
                            Color.fromARGB(0, 0, 0, 0)
                          ],
                          begin: Alignment.bottomCenter,
                          end: Alignment.topCenter,
                        ),
                      ),
                      padding: const EdgeInsets.symmetric(
                          vertical: 10.0, horizontal: 20.0),
                      child: Text(
                        'No. ${imgList.indexOf(item)} image',
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 20.0,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ),
                ],
              )),
        ))
    .toList();

class ComplicatedImageDemo extends StatelessWidget {
  const ComplicatedImageDemo({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Complicated image slider demo')),
      body: CarouselSlider(
        options: CarouselOptions(
          autoPlay: true,
          aspectRatio: 2.0,
          enlargeCenterPage: true,
        ),
        items: imageSliders,
      ),
    );
  }
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  var _lsCategorias = <CategoriasModel>[];

  Future<void> getDatos() async {
    _lsCategorias = await CategoriasProvider().getCategorias();
    setState(() {});
  }

  @override
  Widget build(BuildContext context) {
    getDatos();
    return MaterialApp(
      //theme material
      theme: ThemeData(
        primaryColor: const Color.fromARGB(255, 3, 196, 99),
        accentColor: const Color.fromARGB(255, 3, 196, 99),
        useMaterial3: true,
      ),
      debugShowCheckedModeBanner: false,
      initialRoute: 'main',
      routes: {
        'grutas': (BuildContext context) {
          final categoria =
              ModalRoute.of(context)!.settings.arguments as CategoriasModel;
          return GrutasPage(categoria: categoria);
        },
      },
      title: 'Material App',
      home: Scaffold(
        floatingActionButton: FloatingActionButton(onPressed: getDatos),
        drawer: Drawer(
          child: Column(
            children: [
              getMenuWidget(),
              Expanded(
                child: ListView.builder(
                  itemCount: _lsCategorias.length,
                  itemBuilder: (BuildContext context, int index) {
                    return ListTile(
                      title: Text(_lsCategorias[index].nbCategoria),
                      onTap: () {
                        if (_lsCategorias[index].nbCategoria == 'Inicio') {
                          Navigator.pop(context);
                        } else {
                          Navigator.pushNamed(context, 'grutas',
                              arguments: _lsCategorias[index]);
                        }
                      },
                    );
                  },
                ),
              ),
            ],
          ),
        ),
        appBar: AppBar(
          title: const Text(
            'SartenejaII',
            style: TextStyle(
              color: Colors.white,
            ),
          ),
          backgroundColor: const Color.fromARGB(255, 3, 196, 99),
        ),
        body: CarouselSlider(
          options: CarouselOptions(
            autoPlay: true,
            aspectRatio: 2.0,
            enlargeCenterPage: true,
          ),
          items: imageSliders,
        ),
      ),
    );
  }

  UserAccountsDrawerHeader getMenuWidget() {
    return const UserAccountsDrawerHeader(
      accountName: Text("Sartenejas II"),
      accountEmail: Text("Bienvenido"),
      currentAccountPicture: CircleAvatar(
        backgroundImage: AssetImage("assets/imagenes/logo.png"),
      ),
      decoration: BoxDecoration(
          color: Color.fromARGB(255, 16, 219, 141),
          image: DecorationImage(
            image: AssetImage("assets/imagenes/bgd.jpg"),
            fit: BoxFit.cover,
          )),
    );
  }
}
