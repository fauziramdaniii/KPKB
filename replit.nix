{pkgs}: {
  deps = [
    pkgs.openssh
    pkgs.unzip
    pkgs.php74Packages.composer
    pkgs.php74
  ];
}
