<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileResource\Pages;
use App\Filament\Resources\FileResource\RelationManagers;
use App\Models\File;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FileResource extends Resource
{
    protected static ?string $model = File::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('filepath')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\FileUpload::make('filepath') // Crea un campo de carga de archivos llamado 'filepath'.
                    ->required() // Indica que este campo es obligatorio.
                    ->image() // Especifica que se espera que el archivo sea una imagen.
                    ->maxSize(2048) // Limita el tamaño máximo del archivo a 2048 KB (2MB).
                    ->directory('uploads') // Define el directorio de almacenamiento para los archivos cargados.
                    ->getUploadedFileNameForStorageUsing(function (Livewire\TemporaryUploadedFile $file): string {
                        $size = $file->getSize(); // Obtiene el tamaño del archivo.
                        $sizeInKb = round($size / 1024, 2); // Convierte el tamaño a KB (opcional).
                        
                        return [
                            'path' => time() . '_' . $file->getClientOriginalName(),
                            'filesize' => $sizeInKb // Asigna el tamaño del archivo a la columna 'filesize'.
                        ];
                    }),
                Forms\Components\TextInput::make('filesize')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('filepath'),
                Tables\Columns\TextColumn::make('filesize'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFiles::route('/'),
        ];
    }
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $filepath = $data['filepath'];
        $data['filesize'] = Storage::disk('public')->size($filepath);
       
        return $data;
    }
 
}
