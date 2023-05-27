class FotoProductosModel {
  final String idFoto;
  final String idLugar;
  final String pathFoto;

  FotoProductosModel({
    required this.idFoto,
    required this.idLugar,
    required this.pathFoto,
  });

  FotoProductosModel copyWith({
    String? idFoto,
    String? idLugar,
    String? pathFoto,
  }) =>
      FotoProductosModel(
        idFoto: idFoto ?? this.idFoto,
        idLugar: idLugar ?? this.idLugar,
        pathFoto: pathFoto ?? this.pathFoto,
      );

  factory FotoProductosModel.fromJson(Map<String, dynamic> json) =>
      FotoProductosModel(
        idFoto: json["idFoto"],
        idLugar: json["idLugar"],
        pathFoto: json["pathFoto"],
      );

  Map<String, dynamic> toJson() => {
        "idFoto": idFoto,
        "idLugar": idLugar,
        "pathFoto": pathFoto,
      };
}
