class CategoriasModel {
  final String idCategoria;
  final String nbCategoria;

  CategoriasModel({
    required this.idCategoria,
    required this.nbCategoria,
  });

  CategoriasModel copyWith({
    String? idCategoria,
    String? nbCategoria,
  }) =>
      CategoriasModel(
        idCategoria: idCategoria ?? this.idCategoria,
        nbCategoria: nbCategoria ?? this.nbCategoria,
      );

  factory CategoriasModel.fromJson(dynamic json) => CategoriasModel(
        idCategoria: json["idCategoria"],
        nbCategoria: json["nbCategoria"],
      );

  Map<String, dynamic> toJson() => {
        "idCategoria": idCategoria,
        "nbCategoria": nbCategoria,
      };
}
