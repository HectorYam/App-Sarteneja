import 'package:sartenejas_app/model/categorias_model.dart';

class CategoriasResponseModel {
  final int idEstatus;
  final List<CategoriasModel> data;
  final String mensaje;

  CategoriasResponseModel({
    required this.idEstatus,
    required this.data,
    required this.mensaje,
  });

  CategoriasResponseModel copyWith({
    int? idEstatus,
    List<CategoriasModel>? data,
    String? mensaje,
  }) =>
      CategoriasResponseModel(
        idEstatus: idEstatus ?? this.idEstatus,
        data: data ?? this.data,
        mensaje: mensaje ?? this.mensaje,
      );

  factory CategoriasResponseModel.fromJson(dynamic json) =>
      CategoriasResponseModel(
        idEstatus: json["idEstatus"],
        data: List<CategoriasModel>.from(
            json["data"].map((x) => CategoriasModel.fromJson(x))),
        mensaje: json["mensaje"],
      );

  Map<String, dynamic> toJson() => {
        "idEstatus": idEstatus,
        "data": List<dynamic>.from(data.map((x) => x.toJson())),
        "mensaje": mensaje,
      };
}
