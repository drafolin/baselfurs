{
  inputs = {
    nixpkgs.url = "github:nixos/nixpkgs/nixos-unstable";
  };
  outputs =
    { self, nixpkgs }:
    let
      system = "x86_64-linux";
      pkgs = import nixpkgs { inherit system; };
    in
    {
      devShells.${system}.default = pkgs.mkShell {
        packages = [
          pkgs.php82
        ]
        ++ (with pkgs.php82Packages; [
          composer
        ]);

        shellHook = ''
          set -e

          export PATH="$PATH:$(pwd)/vendor/bin"
          export PATH="$PATH:$(pwd)/node_modules/.bin"

          if [ ! -d "$(pwd)/vendor" ]; then
            echo "Installing dependencies..."
            composer install --ignore-platform-reqs
          fi

          if [ ! -f $(pwd)/.env ]; then
            echo "Creating default .env file. You need to configure it manually."
            cp $(pwd)/.env.example $(pwd)/.env
            exit 1
          fi

          sail up -d

          if sail shell -c "ps -e | grep node"; then
            echo "Vite is already running; skipping..."
          else
            echo "Starting Vite..."
            sail npm run dev 2>&1 > $(pwd)/storage/logs/sail.log &
          fi

          if [[ $- == *i* ]] && command -v fish >/dev/null 2>&1; then
            fish
          fi
        '';
      };
    };
}
