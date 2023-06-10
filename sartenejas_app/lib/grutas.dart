import 'dart:developer';

import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:sartenejas_app/model/categorias_model.dart';
import 'package:sartenejas_app/model/lugares_model.dart';
import 'package:sartenejas_app/model/response/lugares_response_model.dart';
import 'package:sartenejas_app/utils/utils.dart';

class GrutasPage extends StatefulWidget {
  const GrutasPage({Key? key, required this.categoria}) : super(key: key);

  final CategoriasModel categoria;

  @override
  State<GrutasPage> createState() => _GrutasPageState();
}

class _GrutasPageState extends State<GrutasPage> {
  var _lsLugares = <LugaresModel>[];
  Future<void> getLugares() async {
    final dio = Dio();

    String url = "${Utils.urlBase}${Api.getLugaresByCategoria}";
    final dataRequest = {
      "idCategoria": widget.categoria.idCategoria,
    };
    final response = await dio.post(
      url,
      options: Options(headers: {
        'Content-Type': 'application/json; charset=UTF-8',
      }),
      data: dataRequest,
    );
    var res = LugaresResponseModel.fromJson(response.data);
    if (res.idEstatus == 1) {
      if (mounted) {
        setState(() {
          _lsLugares = res.data;
        });
      }
    } else {
      log(res.mensaje);
    }
  }

  //Hola Mundo

  @override
  Widget build(BuildContext context) {
    getLugares();
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.categoria.nbCategoria),
      ),
      body: ListView.builder(
        itemCount: _lsLugares.length,
        itemBuilder: (BuildContext context, int index) {
          return Card(
            //card material
            elevation: 5.0,

            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(10.0),
            ),
            margin: EdgeInsets.all(10),
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: ListTile(
                leading: //circle image
                    CircleAvatar(
                  backgroundImage: NetworkImage(_lsLugares[index].imgLugar),
                ),
                title: Text(_lsLugares[index].nbLugar),
                //subtitle: Text(_lsLugares[index].nbDescripcion),
                onTap: () {
                  Navigator.pushNamed(context, 'detalleLugar',
                      arguments: _lsLugares[index]);
                },
              ),
            ),
          );
        },
      ),
    );
  }
}
