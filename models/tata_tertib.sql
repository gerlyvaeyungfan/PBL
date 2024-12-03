USE [tata_tertib]
GO
/****** Object:  Table [dbo].[akun]    Script Date: 03/12/2024 20:58:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[akun](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[role] [nvarchar](9) NOT NULL,
	[username] [varchar](50) NOT NULL,
	[password] [nvarchar](255) NOT NULL,
 CONSTRAINT [PK_akun] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dosen]    Script Date: 03/12/2024 20:58:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dosen](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama] [varchar](50) NOT NULL,
	[nidn] [varchar](10) NOT NULL,
	[jk] [nvarchar](10) NULL,
	[alamat] [varchar](255) NULL,
	[email] [varchar](50) NULL,
	[foto_dosen] [varchar](255) NULL,
	[akun_id] [int] NOT NULL,
 CONSTRAINT [PK_dosen] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[laporan]    Script Date: 03/12/2024 20:58:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[laporan](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[dosen_id] [int] NOT NULL,
	[mhs_id] [int] NOT NULL,
	[tgl_laporan] [date] NOT NULL,
	[pelanggaran_id] [int] NOT NULL,
	[status_verivikasi] [bit] NULL,
	[tgl_veriifikasi] [date] NULL,
	[dpa_id] [int] NOT NULL,
 CONSTRAINT [PK_laporan] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[mahasiswa]    Script Date: 03/12/2024 20:58:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[mahasiswa](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama] [varchar](50) NOT NULL,
	[nim] [varchar](10) NOT NULL,
	[jk] [nvarchar](10) NOT NULL,
	[ttl] [varchar](255) NOT NULL,
	[alamat] [varchar](50) NOT NULL,
	[email] [varchar](50) NOT NULL,
	[prodi] [varchar](4) NOT NULL,
	[kelas] [varchar](2) NOT NULL,
	[dpa_id] [int] NOT NULL,
	[foto_mahasiswa] [varchar](255) NULL,
	[akun_id] [int] NOT NULL,
 CONSTRAINT [PK_mahasiswa] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pelanggaran]    Script Date: 03/12/2024 20:58:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pelanggaran](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[deskripsi] [varchar](300) NOT NULL,
	[tingkat] [int] NOT NULL,
 CONSTRAINT [PK_pelanggaran] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[sanksi]    Script Date: 03/12/2024 20:58:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sanksi](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[laporan_id] [int] NOT NULL,
	[deskripsi] [varchar](255) NOT NULL,
	[file_bukti] [varchar](255) NULL,
	[status] [bit] NULL,
	[tgl_sanksi] [date] NULL,
 CONSTRAINT [PK_sanksi] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[akun] ON 

INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (7, N'admin', N'admin', N'$2y$10$t9Gz10izTPl7Xku6MyPdlOnkmgawj18Tt848AOzjvAo0.srumQ03W')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (9, N'dosen', N'dosen1', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (13, N'dosen', N'dosen2', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (14, N'dosen', N'dosen3', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (15, N'dosen', N'dosen4', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (16, N'dosen', N'dosen5', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (17, N'dosen', N'dosen6', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (25, N'mahasiswa', N'mhs1', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (26, N'mahasiswa', N'mhs2', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (27, N'mahasiswa', N'mhs3', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (28, N'mahasiswa', N'mhs4', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (29, N'mahasiswa', N'mhs5', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (30, N'mahasiswa', N'mhs6', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (31, N'mahasiswa', N'mhs7', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (32, N'mahasiswa', N'mhs8', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (33, N'mahasiswa', N'mhs9', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (34, N'mahasiswa', N'mhs10', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (35, N'mahasiswa', N'mhs11', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (36, N'mahasiswa', N'mhs12', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (37, N'mahasiswa', N'mhs13', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (38, N'mahasiswa', N'mhs14', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (39, N'mahasiswa', N'mhs15', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (40, N'mahasiswa', N'mhs16', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (41, N'mahasiswa', N'mhs17', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (42, N'mahasiswa', N'mhs18', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (43, N'mahasiswa', N'mhs19', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (46, N'mahasiswa', N'mhs20', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (47, N'mahasiswa', N'mhs21', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (48, N'mahasiswa', N'mhs22', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (49, N'mahasiswa', N'mhs23', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (50, N'mahasiswa', N'mhs24', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (51, N'mahasiswa', N'mhs25', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (52, N'mahasiswa', N'mhs26', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (53, N'mahasiswa', N'mhs27', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (54, N'mahasiswa', N'mhs28', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (55, N'mahasiswa', N'mhs29', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (56, N'mahasiswa', N'mhs30', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (57, N'mahasiswa', N'mhs31', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (58, N'mahasiswa', N'mhs32', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (59, N'mahasiswa', N'mhs33', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (60, N'mahasiswa', N'mhs34', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (61, N'mahasiswa', N'mhs35', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (62, N'mahasiswa', N'mhs36', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (63, N'mahasiswa', N'mhs37', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (64, N'mahasiswa', N'mhs38', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (65, N'mahasiswa', N'mhs39', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (66, N'mahasiswa', N'mhs40', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (67, N'mahasiswa', N'mhs41', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (68, N'mahasiswa', N'mhs42', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (69, N'mahasiswa', N'mhs43', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (70, N'mahasiswa', N'mhs44', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (71, N'mahasiswa', N'mhs45', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (72, N'mahasiswa', N'mhs46', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (73, N'dosen', N'dosen7', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (74, N'dosen', N'dosen8', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (75, N'dosen', N'dosen9', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (76, N'dosen', N'dosen10', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (77, N'dosen', N'dosen11', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (78, N'dosen', N'dosen12', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (79, N'dosen', N'dosen13', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (81, N'dosen', N'dosen14', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (82, N'dosen', N'dosen15', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (83, N'dosen', N'dosen16', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (84, N'dosen', N'dosen17', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (85, N'dosen', N'dosen18', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (86, N'dosen', N'dosen19', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (87, N'dosen', N'dosen20', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (88, N'dosen', N'dosen21', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (89, N'dosen', N'dosen22', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (90, N'dosen', N'dosen23', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (91, N'dosen', N'dosen24', N'$2y$10$Lhd7l/FqA/NXjQ10H3apkeO4hFy.Sec5JtVzIqz1qMc7fJ7i8IYpe')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (92, N'mahasiswa', N'mhs47', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
INSERT [dbo].[akun] ([id], [role], [username], [password]) VALUES (93, N'mahasiswa', N'mhs48', N'$2y$10$zMfT.y5u5LzJ0XjT0zI5yeY2y9HfWq.WX89smhvh2wTcKcKLrIM.e')
SET IDENTITY_INSERT [dbo].[akun] OFF
GO
SET IDENTITY_INSERT [dbo].[dosen] ON 

INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (1, N'Vit Zuraida, S.Kom.,M.Kom', N'199011248', N'Perempuan', N'Malang', N'VitZuraida@polinema.ac.id', N'https://drive.google.com/file/d/19v0Q2xsiF923bQV5tAaJw0sgLM1898sW/view?usp=sharing', 9)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (2, N'Rawansyah, Drs., M.Pd', N'198901101', N'Laki-laki', N'Malang', N'rawansyah@polinema.ac.id', N'https://drive.google.com/file/d/19v0Q2xsiF923bQV5tAaJw0sgLM1898sW/view?usp=sharing', 13)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (3, N'Widaningsih, S.Psi, SH., MH', N'1990151034', N'Perempuan', N'Malang', N'widaningsih@polinema.ac.id', N'https://drive.google.com/file/d/1B89_hAR6x8dsjPj3zc7diyftPdCyH_hI/view?usp=sharing', 14)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (4, N'Indra Dharma Wijaya, ST., M.T', N'1985011002', N'Laki-laki', N'Surabaya', N'IndraDharma@polinema.ac.id', N'https://drive.google.com/file/d/1ZIE8zPB-DRtVpM8a-eYPfcItJs3XXTj7/view?usp=sharing', 15)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (5, N'Cahya Rahmad, ST., M.Kom., Dr. Eng', N'1986010802', N'Laki-laki', N'Malang', N'CahyaRahmad@polinema.ac.id', N'https://drive.google.com/file/d/1n6azdCf2ZCXbs9yDsUBCiQ5XCIByc6yz/view?usp=sharing', 16)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (6, N'Dwi Puspitasari, S.Kom., M.Kom', N'1985017509', N'Perempuan', N'Malang', N'DwiPuspitasari@polinema.ac.id', N'https://drive.google.com/file/d/1LcL-GXgblp5ZLNG4eEQd8FGqbwRgf26g/view?usp=sharing', 17)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (7, N'Deddy Kusbianto PA, Ir., M.Mkom.
', N'1990014998', N'Laki-laki', N'Surabaya', N'DeddyKusbianto@polinema.ac.id', N'https://drive.google.com/file/d/1oewaeZLJlcrssFs5racQ791lGm8ztnTk/view?usp=sharing', 73)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (8, N'Budi Harijanto, ST., M.Kom', N'1989015058', N'Laki-laki', N'Blitar', N'BudiHarijanto@polinema.ac.id', N'https://drive.google.com/file/d/1JfrkHScxm6nA0YN7P4Qp2fzxBtYuNjd0/view?usp=sharing', 74)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (9, N'Ariadi Retno Ririd, S.Kom., M.Kom.', N'1990022207', N'Perempuan', N'Pasuruan', N'AriadiRetno@polinema.ac.id', N'https://drive.google.com/file/d/1alX29Ft8CIJ9zocIHylBr3e8lcPhkHIx/view?usp=sharing', 75)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (10, N'Banni Satria Andoko, S.Kom., M.MSI., Dr. Eng.
', N'1990021996', N'Laki-laki', N'Malang', N'BanniSatria@polinema.ac.id', N'https://drive.google.com/file/d/11ACKDU2tM9A40uafjwCbpDXKS89qPPB1/view?usp=sharing', 76)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (11, N'Meyti Eka Apriyani, S.T., M.T', N'1987060215', N'Perempuan', N'Tulungagung', N'MeytiEka@polinema.ac.id', N'https://drive.google.com/file/d/19v0Q2xsiF923bQV5tAaJw0sgLM1898sW/view?usp=sharing', 77)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (12, N'Ekojono, ST., M.Kom', N'1990015154', N'Laki-laki', N'Pasuruan', N'Ekojono@polinema.ac.id', N'https://drive.google.com/file/d/1U7xQBoBSB3UK6zhjieuwU_bggAJVP-pI/view?usp=sharing', 78)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (13, N'Dhebys Suryani, S.Kom., MT
', N'1990015303', N'Perempuan', N'Surabaya', N'DhebysSuryani@polinema.ac.id', N'https://drive.google.com/file/d/17p3WFXX9bZlEdwWcoj7SkRbtl_ebKdSR/view?usp=sharing', 79)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (14, N'Ahmadi Yuli Ananta, S.T., M.M', N'1989015017', N'Laki-laki', N'Kediri', N'AhmadiYuli@polinema.ac.id', N'https://drive.google.com/file/d/1-atBBGKekcZ3o35CRPJXKRanOKPkUrZm/view?usp=sharing', 81)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (15, N'Dr. Ely Setyo Astuti, S.T., M.T', N'1990022225', N'Perempuan', N'Blitar', N'ElySetyo@polinema.ac.id', N'https://drive.google.com/file/d/1s_8VfKz3gc4L5hwX9K_A0H1csUMehu76/view?usp=sharing', 82)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (16, N'Vivi Nur Wijayanti, S.Kom., M.Kom', N'1990017134', N'Perempuan', N'Tulungagung', N'ViviNur@polinema.ac.id', N'https://drive.google.com/file/d/19v0Q2xsiF923bQV5tAaJw0sgLM1898sW/view?usp=sharing', 83)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (17, N'Imam Fahrur Rozi, ST., MT.
', N'1990011008', N'Laki-laki', N'Pasuruan', N'ImamFahrur@polinema.ac.id', N'https://drive.google.com/file/d/10aHUXeVqFGVoLc55nh0yizJy_Z_PMSON/view?usp=sharing', 84)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (18, N'Hendra Pradipta, SE., MSc', N'1988112318', N'Laki-laki', N'Surabaya', N'HendraPradipta@polinema.ac.id', N'https://drive.google.com/file/d/1gd-EU2ok5s41weZS2rzkbdul42FkMG_I/view?usp=sharing', 85)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (19, N'Arief Prasetyo, S.Kom.', N'1990014709', N'Laki-laki', N'Malang', N'AriefPrasetyo@polinema.ac.id', N'https://drive.google.com/file/d/1Sj4RRk9ZTxJX5E7qr7Mp2lbnVvMUp-Oy/view?usp=sharing', 86)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (20, N'Annisa Puspa Kirana, S.Kom., M.Kom', N'1989016118', N'Perempuan', N'Pasuruan', N'AnnisaPuspa@polinema.ac.id', N'https://drive.google.com/file/d/1IkmaefkmWgZMgrcMjERM-Cty3HBM0oYn/view?usp=sharing', 87)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (21, N'Gunawan Budi Prasetyo, ST., MMT., Ph.D', N'1985025557', N'Laki-laki', N'Blitar', N'AnugrahNur@polinema.ac.id', N'https://drive.google.com/file/d/1Nq3ZaShLaep-MLEWKWs0eFnhaHpQ7mAz/view?usp=sharing', 88)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (22, N'Erfan Rohadi, ST., M.Eng., Ph.D', N'1990017204', N'Laki-laki', N'Kediri', N'ErfanRohadi@polinema.ac.id', N'https://drive.google.com/file/d/1HSozByetDtHqVSvhp0XcOvrWHFSOnFpp/view?usp=sharing', 90)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (23, N'Kadek Suranina Batubulan, S.Kom, MT', N'1970031831', N'Laki-laki', N'Pasuruan', N'KadekSuranina@polinema.ac.id', N'https://drive.google.com/file/d/19v0Q2xsiF923bQV5tAaJw0sgLM1898sW/view?usp=sharing', 91)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (26, N'Luqman Affandi, S.Kom., MMSI
', N'1978091067', N'Laki-laki', N'Malang', N'LuqmanSuranina@polinema.ac.id', N'https://drive.google.com/file/d/10aHUXeVqFGVoLc55nh0yizJy_Z_PMSON/view?usp=sharing', 89)
INSERT [dbo].[dosen] ([id], [nama], [nidn], [jk], [alamat], [email], [foto_dosen], [akun_id]) VALUES (27, N'Mungki Astiningrum, ST., M.Kom.', N'1987081180', N'Perempuan', N'Malang', N'MungkiAstiningrum@polinema.ac.id', N'https://drive.google.com/file/d/1CQvtMP3cK2OUaAGgXOnxmQSvwPv82dt4/view?usp=sharing', 7)
SET IDENTITY_INSERT [dbo].[dosen] OFF
GO
SET IDENTITY_INSERT [dbo].[laporan] ON 

INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (1, 2, 14, CAST(N'2024-11-30' AS Date), 3, 1, CAST(N'2024-11-30' AS Date), 7)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (2, 10, 5, CAST(N'2024-12-01' AS Date), 7, 1, CAST(N'2024-12-03' AS Date), 3)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (5, 5, 1, CAST(N'2024-11-15' AS Date), 6, 0, NULL, 1)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (7, 12, 9, CAST(N'2024-10-20' AS Date), 13, 0, NULL, 5)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (8, 4, 6, CAST(N'2024-11-25' AS Date), 29, 0, NULL, 3)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (9, 18, 24, CAST(N'2024-11-10' AS Date), 21, 1, CAST(N'2024-11-15' AS Date), 12)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (10, 20, 8, CAST(N'2024-12-02' AS Date), 20, 1, CAST(N'2024-12-05' AS Date), 4)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (12, 17, 46, CAST(N'2024-11-29' AS Date), 15, 1, CAST(N'2024-12-02' AS Date), 23)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (15, 26, 33, CAST(N'2024-11-08' AS Date), 24, 0, NULL, 17)
INSERT [dbo].[laporan] ([id], [dosen_id], [mhs_id], [tgl_laporan], [pelanggaran_id], [status_verivikasi], [tgl_veriifikasi], [dpa_id]) VALUES (16, 21, 22, CAST(N'2024-12-19' AS Date), 19, 0, NULL, 11)
SET IDENTITY_INSERT [dbo].[laporan] OFF
GO
SET IDENTITY_INSERT [dbo].[mahasiswa] ON 

INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (1, N'MUHAMMAD JAMALUDIN', N'2341760029', N'Laki-laki', N'Malang,12 November 2006', N'Malang', N'muh@gmail.com', N'TI', N'1A', 1, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 25)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (2, N'ADAM NUR ALIFI', N'2341760158', N'Laki-laki', N'Surabaya, 10 November 2006', N'Surabaya', N'adam11@gmail.com', N'TI', N'1A', 1, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 26)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (3, N'ADIT BAGUS SADEWA', N'2341760149', N'Laki-laki', N'Tuban, 6 Juni 2005', N'Tuban', N'ditadit@gmail.com', N'TI', N'1B', 2, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 27)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (4, N'VERA EFITA HUDI PUTRI', N'2341760047', N'Perempuan', N'Tuban, 22 September 2004', N'Tuban', N'veraEfit70@gmail.com', N'TI', N'1B', 2, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 28)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (5, N'ERIKA ATTHACARYA PUTRI CAHYANI', N'2341760158', N'Perempuan', N'Blitar, 14 November 2004', N'Blitar', N'hiwltrswalterss@gmail.com', N'TI', N'2A', 3, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 29)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (6, N'FASYA DITA NASAHAH', N'2341760022', N'Perempuan', N'Kediri, 29 Februari 2005', N'Kediri', N'fastfast@gmail.com', N'TI', N'2A', 3, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 30)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (7, N'ATHALLAH FAUZAN', N'2341760131', N'Laki-laki', N'Sidoarjo, 3 Januari 2004', N'Sidorajo', N'atalah@gmail.com', N'TI', N'2B', 4, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 31)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (8, N'AURELLA SEKAR ELLIYANSYAH', N'2341760039', N'Perempuan', N'Malang, 5 Mei 2005', N'Malang', N'aurel90@gmail.com', N'TI', N'2B', 4, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 32)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (9, N'BELQIS IVANA FIDELIA ARFANY', N'2341760075', N'Perempuan', N'Blitar, 10 Januari 2003', N'Blitar', N'belbel109@gmail.com', N'TI', N'3A', 5, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 33)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (10, N'DANICA NASYWA PUTRINIAR', N'2341760023', N'Perempuan', N'Malang, 3 Agustus 2003', N'Malang', N'danicaaa12@gmail.com', N'TI', N'3A', 5, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 34)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (11, N'DHEVINA AGUSTINA', N'2341760034', N'Perempuan', N'Kediri, 9 Juli 2004', N'Kediri', N'devinnaaa@gmail.com', N'TI', N'3B', 6, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 35)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (12, N'ERFIN JAUHARI DWI BRIAN', N'2341760006', N'Laki-laki', N'Malang, 10 Oktober 2003', N'Malang', N'erfinjauh@gmail.com', N'TI', N'3B', 6, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 36)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (13, N'FAIZA ANATHASYA EKA FALEN', N'2341760088', N'Perempuan', N'Malang, 9 Agustus 2003', N'Malang', N'faizz4@gmail.com', N'TI', N'4A', 7, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 37)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (14, N'GERLY VAEYUNGFAN', N'2341760035', N'Laki-laki', N'Malang, 7 Oktober 2002', N'Malang', N'gerlyGer@gmail.com', N'TI', N'4A', 7, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 38)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (15, N'INDI WARA RAMADHANI', N'2341760162', N'Perempuan', N'Malang, 22 Oktober 2002', N'Malang', N'indiwar@gmail.com', N'TI', N'4B', 8, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 39)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (16, N'JADEN NATHA KAUTSAR', N'2341760068', N'Laki-laki', N'Mojokerto, 30 April 2002', N'Mojokerto', N'jadennat@gmail.com', N'TI', N'4B', 8, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 40)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (17, N'JESSICA AMELIA', N'2341760099', N'Perempuan', N'Blitar, 17 Maret 2006', N'Blitar', N'jessiii@gmail.com', N'SIB', N'1A', 9, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 41)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (18, N'LOVELYTA SEKARAYU KRISDIYANTI', N'2341760153', N'Perempuan', N'Malang, 8 Juli 2005', N'Malang', N'loveltya88@gmail.com', N'SIB', N'1A', 9, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 42)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (19, N'MEISY NADIA NABBAN', N'2341760126', N'Perempuan', N'Batam, 7 Juni 2004', N'Batam', N'mesio09@gmail.com', N'SIB', N'1B', 10, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 43)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (20, N'MOCH HAIKAL PUTRA MUHAJIR', N'2341760072', N'Laki-laki', N'Malang, 8 Agustus 2005', N'Malang', N'mochmoch@gmail.com', N'SIB', N'1B', 10, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 46)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (21, N'MUHAMMAD BHIMANTARA WIRA...', N'2341760025', N'Laki-laki', N'Pasuruan, 19 September 2003', N'Pasuruan', N'bimantara70@gmail.com', N'SIB', N'2A', 11, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 47)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (22, N'MUHAMMAD KEMASYAHRU RAM...', N'2341760196', N'Laki-laki', N'Sidoarjo, 24 Januari 2004', N'Sidoarjo', N'muham@gmail.com', N'SIB', N'2A', 11, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 48)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (23, N'MUHAMMAD ROSYID', N'2341760015', N'Laki-laki', N'Malang, 20 Juli 2003', N'Malang', N'rosid88@gmail.com', N'SIB', N'2B', 12, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 49)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (24, N'NIMAS SEPTIANDINI', N'2341760087', N'Perempuan', N'Kediri, 21 Juni 2003', N'Kediri', N'nimas4@gmail.com', N'SIB', N'2B', 12, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 50)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (25, N'BAGUS SAPUTRA', N'2341760110', N'Laki-laki', N'Tulungagung, 11 November 2003', N'Tulungagung', N'bagusus@gmail.com', N'SIB', N'3A', 13, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 51)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (26, N'CITRA WULANDARI', N'2341760111', N'Perempuan', N'Magelang, 17 Agustus 2003', N'Magelang', N'citcitra44@gmail.com', N'SIB', N'3A', 13, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 52)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (27, N'DEWI PRATIWI', N'2341760112', N'Perempuan', N'Pontianak, 4 April 2003', N'Pontianak', N'dewiprat00@gmail.com', N'SIB', N'3B', 14, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 53)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (28, N'EKO SAPUTRO', N'2341760113', N'Laki-laki', N'Balikpapan, 15 Oktober 2002', N'Balikpapan', N'ekosap@gmail.com', N'SIB', N'3B', 14, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 54)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (29, N'FARHAN FIRMANSYAH', N'2341760114', N'Laki-laki', N'Madiun, 10 Desember 2002', N'Madiun', N'farhanooo@gmail.com', N'SIB', N'4A', 15, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 55)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (30, N'GITA MAHARANI', N'2341760115', N'Perempuan', N'Batu, 30 Februari 2002', N'Batu', N'gitagit43@gmail.com', N'SIB', N'4A', 15, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 56)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (31, N'HENDRA SETIAWAN', N'2341760116', N'Laki-laki', N'Tegal, 18 Juni 2003', N'Tegal', N'henhendr0@gmail.com', N'SIB', N'4B', 16, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 57)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (32, N'INDAH KUSUMA', N'2341760117', N'Perempuan', N'Surabaya, 20 Maret 2003', N'Surabaya', N'indahkus@gmail.com', N'SIB', N'4B', 16, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 58)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (33, N'JOKO WIDODO', N'2341760118', N'Laki-laki', N'Padang, 21 Agustus 2006', N'Padang', N'jokowidkk@gmail.com', N'PPLS', N'1A', 17, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 59)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (34, N'KARTINI AYU', N'2341760119', N'Perempuan', N'Medan, 22 April 2005', N'Medan', N'kariayu@gmail.com', N'PPLS', N'1A', 17, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 60)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (35, N'LESTARI CAHYA', N'2341760120', N'Perempuan', N'Malang, 3 Oktober 2006', N'Malang', N'lescah@gmail.com', N'PPLS', N'1B', 18, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 61)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (36, N'MAHARANI PUTRI', N'2341760121', N'Perempuan', N'Bandung, 17 September 2006', N'Bandung', N'maharan@gmail.com', N'PPLS', N'1B', 18, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 62)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (37, N'NIKO SATRIA', N'2341760122', N'Laki-laki', N'Jambi, 8 Agustus 2004', N'Jambi', N'niko100@gmail.com', N'PPLS', N'2A', 19, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 63)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (38, N'OKA WIRAWAN', N'2341760123', N'Laki-laki', N'Cimahi, 6 September 2004', N'Cimahi', N'okaki66@gmail.com', N'PPLS', N'2A', 19, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 64)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (39, N'PUTU WIJAYA', N'2341760124', N'Perempuan', N'Pasuruan, 13 Januari 2005', N'Pasuruan', N'pututuuuu@gmail.com', N'PPLS', N'2B', 20, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 65)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (40, N'QORY SANDIKA', N'2341760125', N'Laki-laki', N'Malang, 16 Juni 2003', N'Malang', N'qorya@gmail.com', N'PPLS', N'2B', 20, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 66)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (41, N'RIZKY RAMADHAN', N'2341760126', N'Laki-laki', N'Samarinda, 2 Februari 2004', N'Samarinda', N'riskyyy@gmail.com', N'PPLS', N'3A', 21, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 67)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (42, N'SARAH ANDINI', N'2341760127', N'Perempuan', N'Malang, 11 Agustus 2003', N'Malang', N'sarahhh50@gmail.com', N'PPLS', N'3A', 21, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 68)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (43, N'TAUFIK HIDAYAT', N'2341760128', N'Laki-laki', N'Malang, 5 Mei 2003', N'Malang', N'taufikk@gmail.com', N'PPLS', N'3B', 22, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 69)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (44, N'UMI LATIFAH', N'2341760129', N'Perempuan', N'Sidoarjo, 18 Juli 2004', N'Sidoarjo', N'umilat@gmail.com', N'PPLS', N'3B', 22, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 70)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (45, N'VINA ANGGRAENI', N'2341760130', N'Perempuan', N'Blitar, 11 November 2003', N'Blitar', N'vinaanggre@gmail.com', N'PPLS', N'4A', 23, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 71)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (46, N'WAHYU SUSANTO', N'2341760131', N'Laki-laki', N'Pasuruan, 13 Juli 2002', N'Pasuruan', N'wahyususan@gmail.com', N'PPLS', N'4A', 23, N'https://drive.google.com/file/d/1lbPSNH0OC9ufReBYkqJxRPAMKMS9_Kqc/view?usp=sharing', 72)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (47, N'XENA KARTIKA', N'2341760132', N'Perempuan', N'Lumajang, 16 Oktober 2002', N'Lumajang', N'xena100@gmail.com', N'PPLS', N'4B', 26, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 92)
INSERT [dbo].[mahasiswa] ([id], [nama], [nim], [jk], [ttl], [alamat], [email], [prodi], [kelas], [dpa_id], [foto_mahasiswa], [akun_id]) VALUES (84, N'YOSHI MAHARDIKA', N'2341760002', N'Perempuan', N'Kupang, 18 Januari 2003', N'Kupang', N'yosiiiii@gmail.com', N'PPLS', N'4B', 26, N'https://drive.google.com/file/d/1QqJ0lhUbAB5XCsvpEw3MaOvD_X3SSQZS/view?usp=sharing', 93)
SET IDENTITY_INSERT [dbo].[mahasiswa] OFF
GO
SET IDENTITY_INSERT [dbo].[pelanggaran] ON 

INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (1, N'Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain
', 5)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (2, N'Berbusana tidak sopan dan tidak rapi. Seperti: berpakaian ketat, transparan, memakai t-shirt (baju kaos tidak berkerah), tank top, hipster, you can see, rok mini, backless, celana pendek, celana tiga per empat, legging, model celana atau baju koyak, sandal, sepatu sandal di lingkungan kampus.', 4)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (3, N'Mahasiswa laki-laki berambut tidak rapi, gondrong yaitu panjang
 rambutnya melewati batas alis mata di bagian depan, telinga di bagian samping dan menyentuh kerah baju di bagian leher
.', 4)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (4, N'Mahasiswa berambut dengan model punk, dan memakai WIG (rambut palsu terkecuali dengan alasan khusus), dicat selain hitam dan/ atau skinned.
', 4)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (5, N'Makan atau minum di dalam ruang kuliah/laboratorium/bengkel.
', 4)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (6, N'Tidak menjaga kebersihan di seluruh area Polinema
.', 4)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (7, N'Membuat kegaduhan yang mengganggu pelaksanaan perkuliahan atau praktikum yang sedang berlangsung.
', 3)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (8, N'Merokok di luar area kawasan (BEBAS) merokok
.', 3)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (9, N'
Bermain kartu, game online, memutar video/film hiburan di (dalam kelas/laboratorium)
.', 3)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (10, N'Mengotori atau mencoret-coret meja, kursi, tembok, dan fasilitas lain di lingkungan Polinema
.', 3)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (11, N'Bertingkah laku kasar atau tidak sopan kepada mahasiswa lain, dosen, dan/atau karyawan.
', 3)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (12, N'Merusak sarana dan prasarana yang ada di area Polinema
.', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (13, N'Tidak menjaga ketertiban dan keamanan di seluruh area Polinema
.', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (14, N'Melakukan pengotoran/pengrusakan barang milik orang lain termasuk inventaris milik Politeknik Negeri Malang
.', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (15, N'Mengakses materi pornografi, melakukan tindakan asusila di kelas atau area kampus
.', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (16, N'Membawa dan/atau menggunakan senjata tajam atau sejenisnya dan/atau senjata api untuk hal kriminal.', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (17, N'Melakukan perkelahian, kekerasan serta membentuk geng/ kelompok yang bertujuan negatif.
', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (18, N'Melakukan kegiatan politik praktis di dalam kampus
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (19, N'Melakukan penyalahgunaan identitas mahasiswa/i dan institusi untuk perbuatan negatif
', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (20, N'Mengancam (menghina, membully) baik tertulis atau tidak tertulis kepada mahasiswa lain, dosen, dan/atau karyawan.', 2)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (21, N'Mencuri barang inventaris institusi dalam bentuk apapun
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (22, N'Melakukan kecurangan dalam bidang akademik, administratif, dan keuangan.
', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (23, N'Melakukan pemerasan dan/atau penipuan
', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (24, N'Melakukan pelecehan dan/atau tindakan asusila dalam segala bentuk di dalam dan di luar kampus.
', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (25, N'Berjudi, mengkonsumsi minum-minuman keras, dan/ atau bermabuk-mabukan di lingkungan dan di luar lingkungan Kampus
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (26, N'Mengikuti organisasi dan atau menyebarkan faham-faham yang dilarang oleh Pemerintah.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (27, N'Melakukan pemalsuan data pribadi atau institusi
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (28, N'Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (29, N'Tidak menjaga nama baik Polinema di masyarakat dan/ atau mencemarkan nama baik Polinema
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (30, N'Melakukan kegiatan atau sejenisnya yang dapat menurunkan kehormatan Polinema atau martabat Bangsa dan Negara.
', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (31, N'Menggunakan dan/ atau mengedarkan dan/ atau menjual barang-barang psikotropika dan/atau zat-zat Adiktif lainnya
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (32, N'Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh
 Pengadilan
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (33, N'Memarkir kendaraan tidak pada tempatnya
.', 3)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (34, N'Melakukan/menyelenggarakan aktivitas organisasi kemahasiswaan extra kampus di dalam kampus tanpa ijin resmi institusi
.', 3)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (35, N'Melakukan pemalsuan dokumen/tanda tangan
.', 1)
INSERT [dbo].[pelanggaran] ([id], [deskripsi], [tingkat]) VALUES (36, N'Membuat konten video, bukti-bukti elektronik yang bermuatan ujaran yang menimbulkan pencemaran nama baik institusi/jurusan/individu.
', 3)
SET IDENTITY_INSERT [dbo].[pelanggaran] OFF
GO
SET IDENTITY_INSERT [dbo].[sanksi] ON 

INSERT [dbo].[sanksi] ([id], [laporan_id], [deskripsi], [file_bukti], [status], [tgl_sanksi]) VALUES (1, 1, N'Mengepel kamar mandi lantai 7', N'https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1fafiB.img?w=750&h=500&m=6&x=120&y=120&s=280&d=280', 1, CAST(N'2024-12-01' AS Date))
INSERT [dbo].[sanksi] ([id], [laporan_id], [deskripsi], [file_bukti], [status], [tgl_sanksi]) VALUES (2, 2, N'Membersihkan PC', N'https://cdn.antaranews.com/cache/800x533/2020/03/28/membersihkan-komputer.jpeg', 1, CAST(N'2024-12-04' AS Date))
INSERT [dbo].[sanksi] ([id], [laporan_id], [deskripsi], [file_bukti], [status], [tgl_sanksi]) VALUES (3, 9, N'Mengganti rugi barang yang telah dicuri dan membuat video klarifikasi', NULL, 0, NULL)
INSERT [dbo].[sanksi] ([id], [laporan_id], [deskripsi], [file_bukti], [status], [tgl_sanksi]) VALUES (4, 10, N'Memakai kalung bertuliskan "saya meminta maaf telah membully orang lain" selama 1 semester', NULL, 0, NULL)
INSERT [dbo].[sanksi] ([id], [laporan_id], [deskripsi], [file_bukti], [status], [tgl_sanksi]) VALUES (5, 12, N'Cuti akademik ', N'https://klconfucian.edu.my/wp-content/uploads/2022/06/36-bagaimana-pengaturan-cuti-bagi.jpg', 1, CAST(N'2024-12-10' AS Date))
SET IDENTITY_INSERT [dbo].[sanksi] OFF
GO
ALTER TABLE [dbo].[dosen]  WITH CHECK ADD  CONSTRAINT [FK_akun_dosen] FOREIGN KEY([akun_id])
REFERENCES [dbo].[akun] ([id])
GO
ALTER TABLE [dbo].[dosen] CHECK CONSTRAINT [FK_akun_dosen]
GO
ALTER TABLE [dbo].[laporan]  WITH CHECK ADD  CONSTRAINT [FK_laporan_dosen] FOREIGN KEY([dosen_id])
REFERENCES [dbo].[dosen] ([id])
GO
ALTER TABLE [dbo].[laporan] CHECK CONSTRAINT [FK_laporan_dosen]
GO
ALTER TABLE [dbo].[laporan]  WITH CHECK ADD  CONSTRAINT [FK_laporan_dpa] FOREIGN KEY([dpa_id])
REFERENCES [dbo].[dosen] ([id])
GO
ALTER TABLE [dbo].[laporan] CHECK CONSTRAINT [FK_laporan_dpa]
GO
ALTER TABLE [dbo].[laporan]  WITH CHECK ADD  CONSTRAINT [FK_laporan_mahasiswa] FOREIGN KEY([mhs_id])
REFERENCES [dbo].[mahasiswa] ([id])
GO
ALTER TABLE [dbo].[laporan] CHECK CONSTRAINT [FK_laporan_mahasiswa]
GO
ALTER TABLE [dbo].[laporan]  WITH CHECK ADD  CONSTRAINT [FK_laporan_pelanggaran] FOREIGN KEY([pelanggaran_id])
REFERENCES [dbo].[pelanggaran] ([id])
GO
ALTER TABLE [dbo].[laporan] CHECK CONSTRAINT [FK_laporan_pelanggaran]
GO
ALTER TABLE [dbo].[mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_akun_mahasiswa] FOREIGN KEY([akun_id])
REFERENCES [dbo].[akun] ([id])
GO
ALTER TABLE [dbo].[mahasiswa] CHECK CONSTRAINT [FK_akun_mahasiswa]
GO
ALTER TABLE [dbo].[mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_dpa_mahasiswa] FOREIGN KEY([dpa_id])
REFERENCES [dbo].[dosen] ([id])
GO
ALTER TABLE [dbo].[mahasiswa] CHECK CONSTRAINT [FK_dpa_mahasiswa]
GO
ALTER TABLE [dbo].[sanksi]  WITH CHECK ADD  CONSTRAINT [FK_sanksi_laporan_pelanggaran] FOREIGN KEY([laporan_id])
REFERENCES [dbo].[laporan] ([id])
GO
ALTER TABLE [dbo].[sanksi] CHECK CONSTRAINT [FK_sanksi_laporan_pelanggaran]
GO
ALTER TABLE [dbo].[akun]  WITH CHECK ADD  CONSTRAINT [CK_akun_role] CHECK  (([role]='dosen' OR [role]='mahasiswa' OR [role]='admin'))
GO
ALTER TABLE [dbo].[akun] CHECK CONSTRAINT [CK_akun_role]
GO
ALTER TABLE [dbo].[mahasiswa]  WITH CHECK ADD  CONSTRAINT [CK_jk_mahasiswa] CHECK  (([jk]='Perempuan' OR [jk]='Laki-laki'))
GO
ALTER TABLE [dbo].[mahasiswa] CHECK CONSTRAINT [CK_jk_mahasiswa]
GO
