import 'package:sartenejas_app/model/fotos_productos_model.dart';

class LugaresModel {
  final String idLugar;
  final String nbLugar;
  final dynamic nbLugarIngles;
  final dynamic nbLugarMaya;
  final dynamic nbCientifico;
  final dynamic tRecorrido;
  final String desLugar;
  final String idCategoria;
  final List<FotoProductosModel> fotos;

  LugaresModel({
    required this.idLugar,
    required this.nbLugar,
    this.nbLugarIngles,
    this.nbLugarMaya,
    this.nbCientifico,
    this.tRecorrido,
    required this.desLugar,
    required this.idCategoria,
    required this.fotos,
  });

  LugaresModel copyWith({
    String? idLugar,
    String? nbLugar,
    dynamic nbLugarIngles,
    dynamic nbLugarMaya,
    dynamic nbCientifico,
    dynamic tRecorrido,
    String? desLugar,
    String? idCategoria,
    List<FotoProductosModel>? fotos,
  }) =>
      LugaresModel(
        idLugar: idLugar ?? this.idLugar,
        nbLugar: nbLugar ?? this.nbLugar,
        nbLugarIngles: nbLugarIngles ?? this.nbLugarIngles,
        nbLugarMaya: nbLugarMaya ?? this.nbLugarMaya,
        nbCientifico: nbCientifico ?? this.nbCientifico,
        tRecorrido: tRecorrido ?? this.tRecorrido,
        desLugar: desLugar ?? this.desLugar,
        idCategoria: idCategoria ?? this.idCategoria,
        fotos: fotos ?? this.fotos,
      );

  factory LugaresModel.fromJson(Map<String, dynamic> json) => LugaresModel(
        idLugar: json["idLugar"],
        nbLugar: json["nbLugar"],
        nbLugarIngles: json["nbLugarIngles"],
        nbLugarMaya: json["nbLugarMaya"],
        nbCientifico: json["nbCientifico"],
        tRecorrido: json["tRecorrido"],
        desLugar: json["desLugar"],
        idCategoria: json["idCategoria"],
        fotos: List<FotoProductosModel>.from(
            json["fotos"].map((x) => FotoProductosModel.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "idLugar": idLugar,
        "nbLugar": nbLugar,
        "nbLugarIngles": nbLugarIngles,
        "nbLugarMaya": nbLugarMaya,
        "nbCientifico": nbCientifico,
        "tRecorrido": tRecorrido,
        "desLugar": desLugar,
        "idCategoria": idCategoria,
        "fotos": List<dynamic>.from(fotos.map((x) => x.toJson())),
      };
}
