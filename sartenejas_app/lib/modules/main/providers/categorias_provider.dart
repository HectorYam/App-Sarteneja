import 'dart:developer';

import 'package:dio/dio.dart';
import 'package:sartenejas_app/model/categorias_model.dart';
import 'package:sartenejas_app/model/response/caterias_response_model.dart';
import 'package:sartenejas_app/utils/utils.dart';

class CategoriasProvider {
  Future<List<CategoriasModel>> getCategorias() async {
    final dio = Dio();

    String url = "${Utils.urlBase}${Api.getCategorias}";
    final response = await dio.get(url,
        options: Options(headers: {
          'Content-Type': 'application/json; charset=UTF-8',
        }));
    var res = CategoriasResponseModel.fromJson(response.data);
    if (res.idEstatus == 1) {
      return res.data;
    } else {
      log(res.mensaje);
      return [];
    }
  }
}
