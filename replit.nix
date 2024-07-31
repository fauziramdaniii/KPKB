{pkgs}: {
  deps = [
    pkgs.nodePackages.prettier
    pkgs.openssh
    pkgs.unzip
    pkgs.php74Packages.composer
    pkgs.php74
  ];
}
