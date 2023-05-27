import 'package:sartenejas_app/model/lugares_model.dart';

class LugaresResponseModel {
  final int idEstatus;
  final List<LugaresModel> data;
  final String mensaje;

  LugaresResponseModel({
    required this.idEstatus,
    required this.data,
    required this.mensaje,
  });

  LugaresResponseModel copyWith({
    int? idEstatus,
    List<LugaresModel>? data,
    String? mensaje,
  }) =>
      LugaresResponseModel(
        idEstatus: idEstatus ?? this.idEstatus,
        data: data ?? this.data,
        mensaje: mensaje ?? this.mensaje,
      );

  factory LugaresResponseModel.fromJson(Map<String, dynamic> json) =>
      LugaresResponseModel(
        idEstatus: json["idEstatus"],
        data: List<LugaresModel>.from(
            json["data"].map((x) => LugaresModel.fromJson(x))),
        mensaje: json["mensaje"],
      );

  Map<String, dynamic> toJson() => {
        "idEstatus": idEstatus,
        "data": List<dynamic>.from(data.map((x) => x.toJson())),
        "mensaje": mensaje,
      };
}
